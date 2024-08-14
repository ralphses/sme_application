<x-app-layout>
    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, {{ Auth::user()->name }}!</h6>
                    <h5 class="mb-0">Here’s your business overview.</h5>
                </div>
            </div>

            <!-- Overview Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Total Sales</h6>
                            <h3>{{ $data['total_sales'] ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Total Products</h6>
                            <h3>{{ $data['total_products'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Pending Orders</h6>
                            <h3>{{ $data['pending_orders'] ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Total Revenue (N)</h6>
                            <h3>{{ number_format($data['total_revenue'] ?? 0, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Sales -->
            <div class="card mt-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Recent Sales</h4>
                    <a href="{{ route('dashboard.sales') }}" class="btn btn-primary btn-sm">View All Sales</a>
                </div>
                @if(count($recent_sales) < 1)
                    <p class="text-muted">No recent sales found.</p>
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
                        @foreach($recent_sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->customer->name ?? 'N/A' }}</td>
                                <td>{{ number_format($sale->total_amount, 2) }}</td>
                                <td>{{ ucfirst($sale->status) }}</td>
                                <td>{{ $sale->created_at->format('d M, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Products Section -->
            <div class="card mt-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Your Products</h4>
                    <a href="{{ route('dashboard.products') }}" class="btn btn-primary btn-sm">View All Products</a>
                </div>
                @if(count($products) < 1)
                    <p class="text-muted">No products found.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price (N)</th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div><!--end layout-specing-->
    </div><!--end container-->
</x-app-layout>
