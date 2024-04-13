@extends('layouts.app')

@section('title', 'Orders')
@section('content')


<div class="py-3 py-md-5 bg-light">
    <div class="container shadow ">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4 pt-4">My Orders</h4>
            </div>
<div class="table-responsive">

    <table class="table table-striped table-hover table-bordered table-sm table-responsive-sm">
        <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Tracking No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Ordered Date</th>
                        <th scope="col">Status Message</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $orderItem)
                        <tr>
                            <td>{{ $orderItem->id }}</td>
                            <td>{{ $orderItem->tracking_no }}</td>
                            <td>{{ $orderItem->fullname }}</td>
                            <td>{{ $orderItem->payment_mode }}</td>
                            <td>{{ $orderItem->status_message }}</td>
                            <td>{{ $orderItem->created_at->format('d-m-Y') }}</td>
                            <td><a href="{{ route('orders.view', $orderItem->id) }}" class="btn btn-sm btn-primary">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No Order Availiable</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="py-3 float-end ">
                {{ $orders->links() }}
            </div>
        </div>
           
         
        </div>
    </div>
</div>

@endsection
