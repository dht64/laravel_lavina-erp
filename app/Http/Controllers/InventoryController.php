<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Material;
use App\Product;
use App\Supplier;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        $materials = Material::all();
        return view('bowner.inventories.index', compact('products', 'materials', 'purchases'));
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
    public function editProduct($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('bowner.inventories.product.edit', compact('product'));
    }

    public function editMaterial($id)
    {
        //
        $material = Material::findOrFail($id);
        return view('bowner.inventories.material.edit', compact('material'));
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

    }

    public function updateProduct(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        $p_qty = $product->quantity = $request->quantity;

        // If 'hod' so no 'extra'
        if ($request->extra != null) {
            $extra = $product->extra = $request->extra;

            if ($extra >= $product->unit->equi) {
                $product->quantity = $p_qty + floor($extra / $product->unit->equi);
                $product->extra = $extra % $product->unit->equi;
            }
        }

        $product->save();

        Session::flash('updated_message', 'The product available quantity has been updated');

        return redirect('/bowner/inventories');
    }

    public function updateMaterial(Request $request, $id)
    {
        //
        $material = Material::findOrFail($id);
        $material->quantity = $request->quantity;
        $material->save();

        Session::flash('updated_message', 'The material available quantity has been updated');

        return redirect('/bowner/inventories');
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
    }
}
