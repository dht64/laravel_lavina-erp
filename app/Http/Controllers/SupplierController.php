<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::all();

        return view('bowner.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bowner.supplier.create');
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
        $supplier = new Supplier();

        $this->validate($request, [
            'phone' => 'required|digits_between:9,11|unique:suppliers',
        ]);

        $supplier->name = $request->name;
        $supplier->address1 = $request->address1;
        $supplier->address2 = $request->address2;
        $supplier->phone = $request->phone;
        $supplier->description = $request->description;

        $supplier->save();

        Session::flash('created_message', 'The new supplier has been added');

        return redirect('/bowner/supplier');
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
        $supplier = Supplier::findOrFail($id);

        return view('bowner.supplier.edit', compact('supplier'));
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
        $supplier = Supplier::findOrFail($id);

        $this->validate($request, [
            'phone' => 'required|digits_between:9,11|unique:suppliers,phone,'.$supplier->id,
        ]);

        $supplier->name = $request->name;
        $supplier->address1 = $request->address1;
        $supplier->address2 = $request->address2;
        $supplier->phone = $request->phone;
        $supplier->description = $request->description;

        $supplier->save();

        Session::flash('update_message', 'The new supplier has been updated');

        return redirect('/bowner/supplier');
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
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        Session::flash('deleted_message', 'The supplier has been deleted');

        return redirect('/bowner/supplier');
    }
}
