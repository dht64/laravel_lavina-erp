@extends('layouts.print')

@section('content')
    <h2 class="text-center text-primary">Product Delivery</h2>
    <hr>
    <h4>Order ID: <b>{{ $order->id }}</b></h4>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>UOM</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($order->orderdetail()->get() as $detail)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->product->unit->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ date("d-m-Y") }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h4>Inventory Manager Signature</h4>
            <br><br><br><br><br>
        </div>
        <div class="col-md-offset-6 col-md-3">
            <h4>Business Owner Signature</h4>
        </div>
    </div>
</div>
@stop