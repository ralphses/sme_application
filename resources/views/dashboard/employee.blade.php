<x-app-layout>
    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, {{ Auth::user()->name }}!</h6>
                    <h5 class="mb-0">Employee Dashboard</h5>
                </div>
            </div>

            <!-- Dashboard Actions -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Create New Order</h6>
                            <p>Start a new order by providing order details.</p>
                            <a href="{{ route("dashboard.business.order.create") }}" class="btn btn-primary">Create Order</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>Total Orders</h6>
                            <p>{{$total_orders}}</p>
                            <h6>Pending Orders</h6>
                            <p>{{$pending_orders}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card mt-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Recent Orders</h4>
                    <a href="{{ route('dashboard.business.order') }}" class="btn btn-primary">View All Orders</a>
                </div>
                @if(count($recent_sales) < 1)
                    <p class="text-muted">No recent orders found.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount (N)</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recent_sales as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                <td>{{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->created_at->format('d M, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div><!--end layout-specing-->
    </div><!--end container-->
</x-app-layout>
