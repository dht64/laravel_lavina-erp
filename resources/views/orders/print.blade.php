@extends('layouts.print')

@section('content')
    <h2 class="text-center text-primary">Order Delivery</h2>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>UOM</th>
                        <th>Cost/UOM</th>
                        <th>Quantity</th>
                        <th>VAT (5%)</th>
                        <th>Total Cost</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->customer->name}}</td>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->product->unit->name}}</td>
                    <td>{{$order->product->cost}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->vat ? 'Yes' : 'No'}}</td>
                    <td>{{$order->total_cost}}</td>
                    <td>{{date("d-m-Y")}}</td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h4>Customer Signature</h4>
            <br><br><br><br><br>
        </div>
        <div class="col-md-offset-6 col-md-3">
            <h4>Business Owner Signature</h4>
        </div>
    </div>
</div>
@stop