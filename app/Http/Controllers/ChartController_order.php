<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
    	$orders = Order::with('product')->where('status', 1)->orderBy('updated_at', 'desc')->get();
    	$orders = $orders->toArray();
        $orderDaily = [];
        $orderMonthly = [];
    	$orderYearly = [];
        $i = 0;
        $j = 0;
    	foreach($orders as $order) {
    		// get product name in order
            //dd($order);
    		$product = $order['product']['name'];

            // Get Daily Data
    		if ($i == 0) {
    			$orderDaily[$i][$product] = $order['total_cost'];
				$orderDaily[$i]['date'] = date('Y-m-d', strtotime($order['updated_at']));
				$i++; 
    		} else {
	    		// check if same data in order and orderDaily
	    		if (date('Y-m-d', strtotime($order['updated_at'])) == $orderDaily[$i-1]['date']) {
	    			if (array_key_exists($product, $orderDaily[$i-1])) {
	    				$orderDaily[$i-1][$product] += $order['total_cost'];
	    			} else {
	    				$orderDaily[$i-1][$product] = $order['total_cost'];
	    			  } // /else
	    		} else {
	    			$orderDaily[$i][$product] = $order['total_cost'];
					$orderDaily[$i]['date'] = date('Y-m-d', strtotime($order['updated_at']));
					$i++; 
	    		  } // /else $order['date'] == $orderDaily['date']
    		  } // /else $i == 0

            // Get Monthly data
            if ($j == 0) {
                $orderMonthly[$j][$product] = $order['total_cost'];
                $orderMonthly[$j]['date'] = date('Y-m', strtotime($order['updated_at']));
                $j++; 
            } else {
                // check if same data in order and orderMonthly
                if (date('Y-m', strtotime($order['updated_at'])) == $orderMonthly[$j-1]['date']) {
                    if (array_key_exists($product, $orderMonthly[$j-1])) {
                        $orderMonthly[$j-1][$product] += $order['total_cost'];
                    } else {
                        $orderMonthly[$j-1][$product] = $order['total_cost'];
                      } // /else
                } else {
                    $orderMonthly[$j][$product] = $order['total_cost'];
                    $orderMonthly[$j]['date'] = date('Y-m', strtotime($order['updated_at']));
                    $j++; 
                  } // /else $order['date'] == $orderMonthly['date']
              } // /else $j == 0

            // Get Yearly data
            $year = date("Y", strtotime($order['updated_at']));
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
                    $orderYearly[$year][$k2]['revenue'] += $order['total_cost'];
                    $flag = 1; // has same product
                    break;
                    }
                }
                if (!$flag) {
                    $k++;
                    $orderYearly[$year][$k]['product'] = $product;
                    $orderYearly[$year][$k]['revenue'] = $order['total_cost'];
                }
            } else {
                $k = 0;
                $orderYearly[$year][$k]['product'] = $product;
                $orderYearly[$year][$k]['revenue'] = $order['total_cost'];
              } // /else array_key_exists

    	} // /foreach

        $orderDaily = json_encode($orderDaily);
        $orderMonthly = json_encode($orderMonthly);
    	$orderYearly = json_encode($orderYearly);
    	return view('bowner.chart.index', compact('orderDaily', 'orderMonthly', 'orderYearly'));
    }
}
