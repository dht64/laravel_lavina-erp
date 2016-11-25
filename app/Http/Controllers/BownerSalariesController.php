<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Salary;
use App\Human;
use App\Leave;

class BownerSalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $chosenYr = $thisYr = date("Y");
        $chosenMn = $thisMn = date("m");
        $lastYr = $thisYr - 1;
        $lastMn = $thisMn - 1;
        $dates = date("Y-m-01");
        
        /*
        //Create new salary in new month
        if(date("j") == 5){ 
            $humans = Human::pluck('id');

            foreach($humans as $human){
                Salary::create(['human_id'=>$human]);
            }
        }
        */

        if ($request->all()) {
            $chosenMn = $request->month;
            $chosenYr = $request->year;
        }

        $salaries = Salary::whereMonth('dates', '=', $chosenMn)->whereYear('dates', '=', $chosenYr)->get();
        $total = Salary::whereMonth('dates', '=', $chosenMn)->whereYear('dates', '=', $chosenYr)->sum('total');

        return view('bowner.salaries.index', compact('salaries', 'thisYr', 'thisMn', 'chosenYr', 'chosenMn', 'dates', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $dates = $input['dates'];
        $humans = Human::pluck('id');

        foreach($humans as $human){
            $salaries = Salary::where('human_id', $human)->orderBy('dates', 'desc')->first();
            if ($salaries) {
                $salary = Salary::firstOrCreate(['human_id'=>$human, 'dates'=>$dates])->update(['basic_salary'=>$salaries->basic_salary, 'total'=>$salaries->basic_salary]);
            } else {
                $salary = Salary::firstOrCreate(['human_id'=>$human]);
              }
        }

        Session::flash('created_message', 'The salary has been created');

        return redirect('/bowner/salaries');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $salary = Salary::findOrFail($id);
        $leave = Leave::where('human_id', $salary->human_id)->first();

        /*
        //convert mySQL date (Y-m-d) to readable date (d-m-Y)
        if($salary->nondeduct_leave != ""){
            $days1 = explode(",", $salary->nondeduct_leave);
            foreach($days1 as $day) {
                $day1[] = date("d-m-Y", strtotime($day));
            }
            $day_nondeduct = implode(", ", $day1);
        } else $day_nondeduct = "";

        if($salary->deduct_leave != ""){
            $days2 = explode(",", $salary->deduct_leave);
            foreach($days2 as $day){
                $day2[] = date("d-m-Y", strtotime($day));
            }
            $day_deduct = implode(", ", $day2);
        } else $day_deduct = "";
        */

        return view('bowner.salaries.edit', compact('salary', 'leave'));
    }

    // get weekdays function
    private function countDays($year, $month, $ignore) 
    {
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }
        return $count;
    }

    // another get weekdays function
    public function get_weekdays($m,$y) {
        $lastday = date("t",mktime(0,0,0,$m,1,$y));
        $weekdays=0;
        //first 28 days always contains 20 weekdays
        for($d=29;$d<=$lastday;$d++) {
            $wd = date("w",mktime(0,0,0,$m,$d,$y));
            if($wd > 0 && $wd < 6) $weekdays++;
            }
        return $weekdays+20;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $salary = Salary::findOrFail($id);
        $input = $request->all();

        //get number of days of the month of edited salary
        //$d = cal_days_in_month(CAL_GREGORIAN,date("m", strtotime($input['dates'])),date("Y", strtotime($input['dates'])));
        
        //get number of working days
        $d = $this->countDays(date("Y", strtotime($input['dates'])), date("n", strtotime($input['dates'])), array(0, 6));

        //calculate daily payment
        $daily_pay = round($input['basic_salary'] / $d);

        //calculate input deducted leaves
        $num_deduct_leave = $input['deduct_leave'] != ''? count(explode(",", $input['deduct_leave'])) : 0;

        //calculate input non-deducted leaves
        $num_nondeduct_leave = $input['nondeduct_leave'] != ''? count(explode(",", $input['nondeduct_leave'])) : 0;

        //calculate non-deducted leaves change
        $annual_leave_change = $num_nondeduct_leave - $input['annual_leave_input'];

        //get human's available leaves
        $leaves = DB::table('leaves')->where('human_id', $salary->human_id);
        $annual_leaves = $leaves->value('annual_leave');
        $avai_annual_leaves = $leaves->value('avai_annual_leave');

        //flag if submitted leaves > available leaves
        if ($annual_leave_change > $avai_annual_leaves) {
            Session::flash('exceed_leaves', 'Total leaves exceed available leaves');
            return redirect()->back();
        
        } else {
            //calculate final payment
            $input['total'] = $input['basic_salary'] + $input['change'] - $daily_pay * $num_deduct_leave;

            $salary->update($input);

            // If annual leave input updated
            if ($annual_leave_change != 0) {
                DB::table('leaves')->where('human_id', $salary->human_id)->update(['avai_annual_leave'=>$avai_annual_leaves-$annual_leave_change]);
            }

            /*
            // Update Un-paid leave
            if ($num_deduct_leave > 0) {
                $leave = Leave::where('human_id', $salary->human_id)->first();
                $leave->unpaid_leave += $num_deduct_leave;
                $leave->save();
            }
            */

            Session::flash('updated_message', 'The salary has been updated');

            return redirect('bowner/salaries');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $salary = Salary::findOrFail($id);
        $salary->delete();

        Session::flash('deleted_message', 'The salary has been deleted');

        return redirect('bowner/salaries');
    }

    /*
    public function requestedSalary(Request $request)
    {
        $thisYr = date("Y");
        $thisMn = date("m");
        $lastYr = $thisYr - 1;
        $lastMn = $thisMn - 1;

        $salaries = Salary::whereMonth('month', '=', $request->month)->get();

        return view('bowner.salaries.index', compact('salaries', 'thisYr', 'thisMn'));
    }
    */
}
