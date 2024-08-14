@php use App\Models\Order; @endphp
<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, {{ auth()->user()->name }}!</h6>
                    <h5 class="mb-0">Here’s your order overview.</h5>
                </div>
            </div>

            <!-- Search and Sort Bar -->
            <div class="mb-4">
                <form method="GET" action="{{ route('dashboard.orders') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search orders by reference" value="{{ $search }}">
                        <select name="sort_by" class="form-select ms-2">
                            <option value="reference" {{ $sortBy === 'reference' ? 'selected' : '' }}>Sort by Reference</option>
                            <option value="date" {{ $sortBy === 'date' ? 'selected' : '' }}>Sort by Date</option>
                            <option value="status" {{ $sortBy === 'status' ? 'selected' : '' }}>Sort by Status</option>
                        </select>
                        <button class="btn btn-primary ms-2" type="submit">Apply</button>
                    </div>
                </form>
            </div>

            <!-- Order Management -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Order Management</h4>
                    @if($orders->isEmpty())
                        <p class="text-muted">No orders found.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Reference</th>
                                <th scope="col">Date</th>
                                <th scope="col">Total (N)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Business Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->reference }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }}</td>
                                    <td>{{ ucfirst($order->status) }}</td>
                                    <td>{{ $order->business->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Custom Pagination -->
                        <div class="d-flex justify-content-center mt-4 mb-3">
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $orders->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">Prev</a>
                                </li>

                                @php
                                    $start = max(1, $orders->currentPage() - 3);
                                    $end = min($start + 6, $orders->lastPage());
                                @endphp

                                @if($start > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $orders->url(1) }}">1</a>
                                    </li>
                                    @if($start > 2)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $orders->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $orders->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if($end < $orders->lastPage())
                                    @if($end < $orders->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $orders->url($orders->lastPage()) }}">{{ $orders->lastPage() }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">Next</a>
                                </li>
                            </ul>
                        </div>

                    @endif
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
