@extends('layouts.print')

@section('content')
    <h2 class="text-center text-primary">Order Delivery</h2>
    <hr>
    <h4>Order ID: <b>{{ $order->id }}</b></h4>
    <h4>Customer:<b> {{ $order->customer->name }}</b></h4>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>UOM</th>
                        <th>Cost/UOM</th>
                        <th>Quantity</th>
                        <th>VAT (5%)</th>
                        <th>Price ($)</th>
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
                    <td>{{ $detail->product->cost }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $order->vat ? 'Yes' : 'No' }}</td>
                    <td>{{ $detail->total_cost }}</td>
                    <td>{{ date("d-m-Y") }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2"><b>Order Total Price:</b></td>
                    <td><b>{{ $order->total_cost }}</b></td>
                    <td></td>
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