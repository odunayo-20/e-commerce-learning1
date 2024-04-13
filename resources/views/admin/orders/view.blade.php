@extends('layouts.admin')

@section('title', 'Orders')
@section('content')

@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <h4 class="mb-4 pt-4">
            <i class="fa fa-shopping-cart tex-dark"></i> My Order Details
            <a href="{{ route('admin.order') }}" class="btn btn-sm btn-danger float-end mx-1 ">Back</a>
            <a href="{{ route('admin.order.generateInvoice', $order->id) }}" class="btn btn-sm btn-primary float-end mx-1 ">Download Invoice</a>
            <a href="{{ route('admin.order.viewInvoice', $order->id) }}" target="_blank" class="btn btn-sm btn-warning float-end mx-1 ">View Invoice</a>
            <a href="{{ route('admin.order.mail', $order->id) }}" class="btn btn-sm btn-info float-end mx-1 ">Send Invoice via Mail</a>
        </h4>
    </div>
    <div class="card-body">

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


<div class="card">
    <div class="card-body">
        <h4>Order Process (Order Status Update)</h4>
        <hr>
        <div class="row">
            <div class="col-md-5">
                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label>Update Your order status </label>
                    <div class="input-group">
                        <select name="order_status" id="" class="form-select">
                            <option value="">Select Order Status</option>
                            <option value="in Process" {{Request::get('status') == 'in progress' ? 'selected' : ''}}>In Progress</option>
                            <option value="completed" {{Request::get('status') == 'completed' ? 'selected' : ''}}>Completed</option>
                            <option value="pending" {{Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                            <option value="cancelled" {{Request::get('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                            <option value="out-for-delivery" {{Request::get('status') == 'out-for-delivery' ? 'selected' : ''}}>Out for delivery</option>
                        </select>
                        <button type="submit" class="btn btn-primary text-white">Update</button>
                    </div>
                </form>
            </div>

            <div class="col-md-7">
                <br/>
                <h4 class="mt-3"> Currect Order Process: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
            </div>
        </div>
    </div>
</div>


@endsection
