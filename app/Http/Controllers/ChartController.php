<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Purchase;
use App\Salary;
use App\Order;

class ChartController extends Controller
{
    //
    public function keyExistsMulti($key, array $arr)
    {
    	// Check base array
    	if (array_key_exists($key, $arr)) {
    		return true;
    	}

    	// Check arrays contain in this array
    	foreach($arr as $element) {
    		if (is_array($element)) {
    			if (keyExistsMulti($key, $element)) {
    				return true;
    			}
    		}
    	}
    	return false;
    }

    public function valueExist(array $arr, $key, $val)
    {
        // Check value exist
    	foreach ($arr as $item) {
    		if (isset($item[$key]) && $item[$key] = $val)
    			return true;
    	}
    	return false;
    }

    public function index()
    {
        // GET ORDER DATA
        //$orders = Order::with('product')->where('status', 1)->orderBy('updated_at', 'desc')->get();
    	$orders = Order::where('status', 1)->orderBy('updated_at', 'desc')->limit(1000)->get();

        $orderDaily = [];
        $orderMonthly = [];
        $orderYearly = [];
        $i = 0;
        $j = 0;

        foreach ($orders as $order) {
            foreach ($order->orderdetail()->get() as $detail) {
                $product = $detail->product->name;

                // Get Daily Data
                if ($i == 0) {
                    $orderDaily[$i][$product] = $detail->total_cost;
                    $orderDaily[$i]['date'] = date('Y-m-d', strtotime($detail->updated_at));
                    $i++; 
                } else {
                    // check if same data in order and orderDaily
                    if (date('Y-m-d', strtotime($detail->updated_at)) == $orderDaily[$i-1]['date']) {
                        if (array_key_exists($product, $orderDaily[$i-1])) {
                            $orderDaily[$i-1][$product] += $detail->total_cost;
                        } else {
                            $orderDaily[$i-1][$product] = $detail->total_cost;
                          } // /else
                    } else {
                        $orderDaily[$i][$product] = $detail->total_cost;
                        $orderDaily[$i]['date'] = date('Y-m-d', strtotime($detail->updated_at));
                        $i++; 
                      } // /else $order['date'] == $orderDaily['date']
                  } // /else $i == 0

                // Get Monthly data
                if ($j == 0) {
                    $orderMonthly[$j][$product] = $detail->total_cost;
                    $orderMonthly[$j]['date'] = date('Y-m', strtotime($detail->updated_at));
                    $j++; 
                } else {
                    // check if same data in order and orderMonthly
                    if (date('Y-m', strtotime($detail->updated_at)) == $orderMonthly[$j-1]['date']) {
                        if (array_key_exists($product, $orderMonthly[$j-1])) {
                            $orderMonthly[$j-1][$product] += $detail->total_cost;
                        } else {
                            $orderMonthly[$j-1][$product] = $detail->total_cost;
                          } // /else
                    } else {
                        $orderMonthly[$j][$product] = $detail->total_cost;
                        $orderMonthly[$j]['date'] = date('Y-m', strtotime($detail->updated_at));
                        $j++; 
                      } // /else $order['date'] == $orderMonthly['date']
                  } // /else $j == 0

                // Get Yearly data
                $year = date("Y", strtotime($detail->updated_at));
                $flag = 0;

                if (array_key_exists($year, $orderYearly)) {
                    /*
                    if ($k == 0) {
                    $orderYearly[$year][$k]['product'] = $product;
                    $orderYearly[$year][$k]['revenue'] = $order['total_cost'];
                    $k++; 
                    } else {
                    */
                    // check if same data in order and orderYearly[$year]
                    for ($k2 = 0; $k2 <= $k; $k2++ ) {
                        if (in_array($product, $orderYearly[$year][$k2])) {
                        $orderYearly[$year][$k2]['revenue'] += $detail->total_cost;
                        $flag = 1; // has same product
                        break;
                        }
                    }
                    if (!$flag) {
                        $k++;
                        $orderYearly[$year][$k]['product'] = $product;
                        $orderYearly[$year][$k]['revenue'] = $detail->total_cost;
                    }
                } else {
                    $k = 0;
                    $orderYearly[$year][$k]['product'] = $product;
                    $orderYearly[$year][$k]['revenue'] = $detail->total_cost;
                  } // /else array_key_exists

            } // /foreach orderdetail
        } // /foreach order

        // GET SALARY DATA
        $salaries = Salary::orderBy('dates', 'desc')->get();
        //$salaries = $salaries->toArray();
        $salaryMonthly = [];
        $salaryYearly = [];
        $i = 0;
        $j = 0;

        foreach($salaries as $salary) {
            if ($i == 0) {
                $salaryMonthly[$i]['salary'] = $salary->total;
                $salaryMonthly[$i]['date'] = date("Y-m", strtotime($salary->dates));
                $i++;
            } else {
                // check if same month in next salary loop
                if (date("Y-m", strtotime($salary->dates)) == $salaryMonthly[$i-1]['date']) {
                    $salaryMonthly[$i-1]['salary'] += $salary->total;
                } else {
                    $salaryMonthly[$i]['salary'] = $salary->total;
                    $salaryMonthly[$i]['date'] = date("Y-m", strtotime($salary->dates));
                    $i++;
                  }
              }
        }

        // GET PURCHASE DATA
        $purchases = Purchase::orderBy('updated_at', 'desc')->get();
        //$purchases = $purchases->toArray();
        $purchaseMonthly = [];
        $purchaseYearly = [];
        $i = 0;
        $j = 0;

        foreach($purchases as $purchase) {
            if ($i == 0) {
                $purchaseMonthly[$i]['purchase'] = $purchase->quantity * $purchase->material->cost;
                $purchaseMonthly[$i]['date'] = date("Y-m", strtotime($purchase->updated_at));
                $i++;
            } else {
                // check if same month in next purchase loop
                if (date("Y-m", strtotime($purchase->updated_at)) == $purchaseMonthly[$i-1]['date']) {
                    $purchaseMonthly[$i-1]['purchase'] += $purchase->quantity * $purchase->material->cost;
                } else {
                    $purchaseMonthly[$i]['purchase'] = $purchase->quantity * $purchase->material->cost;
                    $purchaseMonthly[$i]['date'] = date("Y-m", strtotime($purchase->updated_at));
                    $i++;
                  }
              }
        }
        // MERGE DATA
        // Add this month to $orderMonthly if not exist
        $thisMonth = date("Y-m");
        $newOrder['date'] = $thisMonth;
        if ( empty($orderMonthly) || $orderMonthly[0]['date'] != $thisMonth) {
            array_unshift($orderMonthly, $newOrder);
        }

        $allMonthly = array_replace_recursive($orderMonthly, $salaryMonthly, $purchaseMonthly); 
        /* Another way of merging 2 arrays on 'key'
        foreach($orderMonthly as $key => $value){
            foreach($salaryMonthly as $salary){
                if($value['date'] == $salary['date']){
                    $orderMonthly[$key]['salary'] = $salary['salary'];
                }  
            }
        }
        */
        
        // GET PROFIT
        $i = 0;
        foreach ($allMonthly as $data) {
            if (!array_key_exists("350ml Bottle", $data)) {
                $data["350ml Bottle"] = 0;
            }
            if (!array_key_exists("550ml Bottle", $data)) {
                $data["550ml Bottle"] = 0;
            }
            if (!array_key_exists("20l Hod", $data)) {
                $data["20l Hod"] = 0;
            }
            if (!array_key_exists("salary", $data)) {
                $data["salary"] = 0;
            }
            if (!array_key_exists("purchase", $data)) {
                $data["purchase"] = 0;
            }

            $allMonthly[$i]['profit'] = $data['350ml Bottle'] + $data['550ml Bottle'] + $data['20l Hod'] - $data['salary'] - $data['purchase'];
            $i++;
        }

        $allMonthly = array_reverse($allMonthly);
        $orderDaily = array_reverse($orderDaily);

        $orderDaily = json_encode($orderDaily); // Format: [{"350ml Bottle":"10.50","date":"2016-11-18","550ml Bottle":"6.00"}]
        $orderMonthly = json_encode($orderMonthly);
        $orderYearly = json_encode($orderYearly); // Format: {"2016":[{"product":"350ml Bottle","revenue":"10.50"},{"product":"550ml Bottle","revenue":"6.00"}]}
        $salaryMonthly = json_encode($salaryMonthly);
        $allMonthly = json_encode($allMonthly);

    	return view('bowner.chart.index', compact('orderDaily', 'orderMonthly', 'orderYearly', 'salaryMonthly', 'allMonthly'));
    }
}
