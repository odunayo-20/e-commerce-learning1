@extends('layouts.admin')

@section('title', 'Orders')
@section('content')


@if (session('error'))
<div class="alert alert-warning" role="alert">
    {{ session('error') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        <h3>Orders
        </h3>
    </div>
    <div class="card-body">


        <form action="" method="get">
            <div class="row">
                <div class="col-md-3">
                    <label for=""> Filter By Date</label>
                    <input type="date" name="date" class="form-control" value="{{ Request::get('date') ?? date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label for=""> Filter By Status</label>
                    <select name="status" id="" class="form-select">
                        <option value="">Select Status</option>
                        <option value="in Process" {{Request::get('status') == 'in progress' ? 'selected' : ''}}>In Progress</option>
                        <option value="completed" {{Request::get('status') == 'completed' ? 'selected' : ''}}>Completed</option>
                        <option value="pending" {{Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                        <option value="cancelled" {{Request::get('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                        <option value="out-for-delivery" {{Request::get('status') == 'out-for-delivery' ? 'selected' : ''}}>Out for delivery</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <br />
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <hr>

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
                        <td><a href="{{ route('admin.order.view', $orderItem->id) }}" class="btn btn-sm btn-primary">View</a></td>
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




@endsection
