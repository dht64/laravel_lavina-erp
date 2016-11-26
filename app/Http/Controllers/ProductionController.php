<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\OrderDetail;
use App\Production;
use App\Material;
use App\Product;
use App\Order;

class ProductionController extends Controller
{
    public function index()
    {
    	$orders = Order::where('deliver', 0)->where('submit', 1)->paginate(10);
        $products = Product::pluck('quantity','id');
        foreach ($products as $key => $value) {
            $flag[$key] = 0;
        }

    	return view('bowner.production.index', compact('orders', 'products', 'flag'));
    }

    public function show($id)
    {
    	$order = Order::findOrFail($id);

    	return view('bowner.production.print', compact('order'));
    }

    public function complete($detail_qty, $id, $p_qty)
    {
        $product = Product::findOrFail($id);
        $material = Material::findOrFail($product->material_id);
        $o_qty = $detail_qty;
        $cur_prod_qty = $product->quantity;
        $p_extra = $product->extra;
        $m_qty = $material->quantity;
        $p_unit_equi = $product->unit->equi;
        $m_unit_equi = $material->unit->equi;

        // update product and material quantity
        if ($p_qty < 0) { $p_qty = 0; }
        $required_p_qty = $o_qty - $p_qty;
        $required_m_qty = intval(ceil(($required_p_qty * $p_unit_equi) / $m_unit_equi ));
        $extra_qty = $p_extra + $required_m_qty * $m_unit_equi - $required_p_qty * $p_unit_equi;
        
        // Include extra calculation
        $check_extra = $required_p_qty * $p_unit_equi % $m_unit_equi;

        // Check if extra is enough for 1 product qty
        if (($check_extra != 0) && ($check_extra <= $p_extra)) {
            $required_m_qty = $required_m_qty - 1;
            $extra_qty = $p_extra - $check_extra; 
        }

        $product->quantity = $cur_prod_qty + $required_p_qty;
        $product->extra = $extra_qty;

        if ($extra_qty > $p_unit_equi) {
            $product->quantity += intval(floor($extra_qty / $p_unit_equi));
            $product->extra = $extra_qty % $p_unit_equi;
        }

        $material->quantity = $m_qty - $required_m_qty; // remain material qty

        $product->save(); 
        $material->save();

        Session::flash('updated_message', 'The production has been updated');

        return redirect()->back();
    }

}
