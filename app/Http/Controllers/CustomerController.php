<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();

        return view('bowner.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bowner.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        //
        $customer = new Customer();

        /*
        $this->validate($request, [
            'phone' => 'required|max:11|unique:customers',
            'tax_num' => 'required|unique:customers',
        ]);
        */

        $customer->name = $request->name;
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->phone = $request->phone;
        $customer->tax_num = $request->tax_num;

        $customer->save();

        Session::flash('created_message', 'The new customer has been added');

        return redirect('/bowner/customer');
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
        $customer = Customer::findOrFail($id);

        return view('bowner.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        //
        $customer = Customer::findOrFail($id);

        /*
        $this->validate($request, [
            'phone' => 'required|max:11|unique:customers,phone,'.$customer->id,
            'tax_num' => 'required|unique:customers,tax_num,'.$customer->id,
        ]);
        */

        $customer->name = $request->name;
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->phone = $request->phone;
        $customer->tax_num = $request->tax_num;

        $customer->save();

        Session::flash('update_message', 'The new customer has been updated');

        return redirect('/bowner/customer');
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
        $customer = Customer::findOrFail($id);

        $customer->delete();

        Session::flash('deleted_message', 'The customer has been deleted');

        return redirect('/bowner/customer');
    }
}
