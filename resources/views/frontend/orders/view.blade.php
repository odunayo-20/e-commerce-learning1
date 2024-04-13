@extends('layouts.app')

@section('title', 'Orders')
@section('content')


<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 shadow">
                <h4 class="mb-4 pt-4">
                    <i class="fa fa-shopping-cart tex-dark"></i> My Order Details
                    <a href="{{ route('orders') }}" class="btn btn-sm btn-danger float-end">Back</a>
                </h4>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details</h5>
                        <hr>
                        <h6>Order id: {{ $order->id }}</h6>
                        <h6>Tracking Id/No: {{ $order->tracking_no }}</h6>
                        <h6>Order Created Date: {{ $order->created_at->format('d-m-Y h:iA') }}</h6>
                        <h6>Payment Mode {{ $order->payment_mode }}</h6>
                        <h6 class="border p-2 text-success">
                            Order Status Message:
                            <span class="text-uppercase">{{ $order->status_message }}</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h5>User Details</h5>
                        <hr>
                        <h6>Full Name: {{ $order->fullname }}</h6>
                        <h6>Email: {{ $order->email }}</h6>
                        <h6>Phone: {{ $order->phone }}</h6>
                        <h6>Address: {{ $order->address }}</h6>
                        <h6>Pin code: {{ $order->pincode }}</h6>

                    </div>

                </div>

                <br />
                <h5>Order Items</h5>
                <hr>

                <div class="table-responsive">

                    <table class="table table-striped table-hover table-bordered table-sm table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">Item ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalAmount = 0;
                            @endphp
                            @forelse ($order->orderItems as $orderItem)
                            <tr>
                                <td width="10%">{{ $orderItem->id }}</td>
                                <td width="10%">
                                    @if($orderItem->product->productImages)

                                    <img src="{{ Storage::url($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="{{ $orderItem->product->name }}">
                                    @else
                                    <img src="" style="width: 50px; height: 50px" alt="">
                                    @endif
                                    
                                </td>
                                <td>
                                    {{ $orderItem->product->name }}
                                    @if($orderItem->productColor)
                                    @if($orderItem->productColor->color)
                                    <span> {{ $orderItem->productColor->color->name }}</span>

                                    @endif
                                    @endif
                                </td>
                                <td>{{ $orderItem->price }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>${{ $orderItem->quantity * $orderItem->price }}</td>
                                @php
                                
                                $totalAmount += $orderItem->quantity * $orderItem->price;
                                @endphp
                            </tr>

                            @empty
                            <tr>
                                <td colspan="7">No Order Availiable</td>
                            </tr>
                            @endforelse

                            <tr>
                                <td colspan="5" class="fw-bold">Total Amount</td>
                                <td colspan="1">${{ $totalAmount }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>
</div>


@endsection
