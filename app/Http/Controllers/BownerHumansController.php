<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests\HumanRequest;
use App\Salary;
use App\Human;
use App\Leave;

class BownerHumansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$humans = Human::all();

		return view('bowner.humans.index', compact('humans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('bowner.humans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HumanRequest $request)
    {
        //
		$input = $request->all();

        /*
        $this->validate($request, [
            'name' => 'required',
            'start_day' => 'required',
            'birth' => 'required',
            'gender' => 'required',
            'address1' => 'required',
            'phone' => 'required|min:9|max:11|unique:humans',
            'idnum' => 'required|min:9|max:12|unique:humans',
            'job' => 'required',
        ]);
        */

        $input['start_day'] = date("Y-m-d", strtotime($input['start_day']));
		$input['birth'] = date("Y-m-d", strtotime($input['birth']));

		if($request->file()){
			$file = $request->file('photo');
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$input['photo'] = $name;
		}

        $human = Human::create($input);
        
        // Create salary for new employee
        Salary::create(['human_id' => $human->id]);
        Leave::create(['human_id' => $human->id]);

        Session::flash('created_message', 'The employee has been added');

		return redirect('/bowner/humans');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
		$human = Human::findOrFail($id);
		$day = date("d-m-Y", strtotime($human->start_day));
        $day_birth = date("d-m-Y", strtotime($human->birth));
		
		return view('bowner.humans.edit', compact('human', 'day', 'day_birth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HumanRequest $request, $id)
    {
        //
		$human = Human::findOrFail($id);
		$input = $request->all();

        /*
        $this->validate($request, [
            'name' => 'required',
            'start_day' => 'required',
            'birth' => 'required',
            'gender' => 'required',
            'address1' => 'required',
            'phone' => 'required|min:9|max:11|unique:humans,phone,'.$human->id,
            'idnum' => 'required|min:9|max:12|unique:humans,idnum,'.$human->id,
            'job' => 'required',
        ]);
        */

		$input['start_day'] = date("Y-m-d", strtotime($input['start_day']));
        $input['birth'] = date("Y-m-d", strtotime($input['birth']));
		
		if($file = $request->file('photo')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$input['photo'] = $name;
		}
		
		$human->update($input);

        Session::flash('updated_message', 'The employee has been updated');
		
		return redirect('bowner/humans');
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
		$human = Human::findOrFail($id);
		if($human->photo){
			unlink(public_path('images/') . $human->photo);
		}
		//unlink(public_path() . $human->photo);
		$human->delete();
		
		Session::flash('deleted_message', 'The user has been deleted');
		
		return redirect('/bowner/humans');
    }
}
