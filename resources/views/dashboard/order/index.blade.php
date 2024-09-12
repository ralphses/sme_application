<x-app-layout>
    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <h4>Sales Orders</h4>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('dashboard.business.order') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search by Order Number" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="sort_by" class="form-control">
                            <option value="" disabled selected>Sort By</option>
                            <option value="order_date" {{ request('sort_by') == 'order_date' ? 'selected' : '' }}>Order Date</option>
                            <option value="total_amount" {{ request('sort_by') == 'total_amount' ? 'selected' : '' }}>Total Amount</option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="order" class="form-control">
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Sales Orders Table -->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($salesOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>₦{{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Custom Pagination -->
            <div class="d-flex justify-content-center">
                {!! $salesOrders->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</x-app-layout>
