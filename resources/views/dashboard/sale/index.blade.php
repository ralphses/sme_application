@php use App\Models\Business; @endphp
<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, Admin!</h6>
                    <h5 class="mb-0">Sales Overview for {{ $date }}</h5>
                </div>
            </div>

            <!-- Date Filter -->
            <div class="mb-4">
                <form method="GET" action="{{ route('dashboard.sales') }}">
                    <div class="input-group">
                        <input type="date" name="date" class="form-control" value="{{ $date }}" required>
                        <button class="btn btn-primary ms-2" type="submit">Filter</button>
                    </div>
                </form>
            </div>

            <!-- Sales Management -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Sales Management</h4>
                    @if($sales->isEmpty())
                        <p class="text-muted">No sales found for {{ $date }}.</p>
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
                            @foreach($sales as $sale)
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

                        <!-- Custom Pagination -->
                        <div class="d-flex justify-content-center mt-4 mb-3">
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $sales->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $sales->previousPageUrl() }}" aria-label="Previous">Prev</a>
                                </li>

                                @php
                                    $start = max(1, $sales->currentPage() - 3);
                                    $end = min($start + 6, $sales->lastPage());
                                @endphp

                                @if($start > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sales->url(1) }}">1</a>
                                    </li>
                                    @if($start > 2)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $sales->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $sales->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if($end < $sales->lastPage())
                                    @if($end < $sales->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sales->url($sales->lastPage()) }}">{{ $sales->lastPage() }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ $sales->currentPage() == $sales->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $sales->nextPageUrl() }}" aria-label="Next">Next</a>
                                </li>
                            </ul>
                        </div>

                    @endif
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
