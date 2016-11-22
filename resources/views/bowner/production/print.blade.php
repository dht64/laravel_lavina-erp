@extends('layouts.print')

@section('content')
    <h2 class="text-center text-primary">Product Delivery</h2>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Product</th>
                        <th>UOM</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->product->unit->name}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{date("d-m-Y")}}</td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h4>Product Owner Signature</h4>
            <br><br><br><br><br>
        </div>
        <div class="col-md-offset-6 col-md-3">
            <h4>Business Owner Signature</h4>
        </div>
    </div>
</div>
@stop