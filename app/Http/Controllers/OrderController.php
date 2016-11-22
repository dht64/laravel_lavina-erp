<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Customer;
use App\Product;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function __construct()
    {
        $this->middleware('bowner_employee');
    }
    */

    public function index()
    {
        //
        $orders = Order::orderBy('created_at', 'asc')->paginate(10);
        $products = Product::pluck('name', 'id')->all();
        $customers = Customer::all();

        return view('orders.index', compact('orders', 'products', 'customers'));
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
        $order = new Order();
        $order->customer_id = $request['customer'];
        $order->user_id = Auth::user()->id;
        $order->vat = $request['vat'];
        $quantity = $order->quantity = $request['quantity'];
        $product_id = $order->product_id = $request['product'];
        $product = Product::where('id', $product_id);
        $cost = $product->value('cost');
        $vat_rate = $product->value('vat_rate');
        if ($order->vat) {
            $total_cost = ($cost * $quantity) + ( $cost * $quantity * $vat_rate / 100 );
        } else {
            $total_cost = $cost * $quantity;
          }
        $order->total_cost = $total_cost;
        $order->note = $request['note'];
        //$order->delivery_at = date("Y-m-d", strtotime($request['delivery_at'] . "+1 day"));
        $order->delivery_at = date("Y-m-d", strtotime($request['delivery_at'] ));

        $order->save();

        Session::flash('created_message', 'The order has been created!');

        return redirect('/orders');
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
        $order = Order::findOrFail($id);

        return view('orders.print', compact('order'));
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
        $order = Order::findOrFail($id);

        // Redirect if not same owner
        if (Auth::user()->isEmployee() && (Auth::user()->username != $order->user->username)) {
          return redirect()->back();
        }

        $products = Product::pluck('name', 'id')->all();
        $customers = Customer::all();
        $delivery_at = date("d-m-Y", strtotime($order->delivery_at));

        return view('orders.edit', compact('order', 'products', 'customers', 'delivery_at'));
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
        $order = Order::findOrFail($id);
        $order->customer_id = $request['customer'];
        $order->user_id = Auth::user()->id;
        $order->vat = $request['vat'];
        $quantity = $order->quantity = $request['quantity'];
        $product_id = $order->product_id = $request['product'];
        $product = Product::where('id', $product_id);
        $cost = $product->value('cost');
        $vat_rate = $product->value('vat_rate');
        if ($order->vat) {
            $total_cost = ($cost * $quantity) + ( $cost * $quantity * $vat_rate / 100 );
        } else {
            $total_cost = $cost * $quantity;
          }
        $order->total_cost = $total_cost;
        $order->note = $request['note'];
        $order->delivery_at = date("Y-m-d", strtotime($request['delivery_at']));

        $order->save();

        Session::flash('updated_message', 'The order has been updated!');

        return redirect('/orders');
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
        $order = Order::findOrFail($id);
        $order->delete();

        Session::flash('deleted_message', 'The order has been deleted');

        return redirect('/orders');
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 1;

        // For Undo feature
        /*
        $order->status = !$order->status;
        if ($order->status == 1) {
            $product_qty = $order->product->quantity - $order->quantity;
        } else {
            $product_qty = $order->product->quantity + $order->quantity;
        }
        */

        $order->save();

        Session::flash('updated_message', 'The order has been completed');

        return redirect('/orders');
    }

    public function submit($id)
    {
        $order = Order::findOrFail($id);
        $order->submit = 1;
        $order->save();

        return redirect('/orders');
    } 

    public function deliver($id)
    {
        $order = Order::findOrFail($id);
        $order->deliver = 1;

        $product = Product::findOrFail($order->product_id);
        // Update product inventory quantity
        $product->quantity = $product->quantity - $order->quantity;

        $order->save();
        $product->save();

        Session::flash('updated_message', 'The order delivery has been submitted');

        return redirect('/orders');
    } 
}
