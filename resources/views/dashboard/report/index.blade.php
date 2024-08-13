<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Reports Overview</h6>
                    <h5 class="mb-0">Business Performance Reports</h5>
                </div>
            </div>

            <!-- Search and Sort Bar -->
            <div class="mb-4">
                <form method="GET" action="{{ route('dashboard.report') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by Business Name" value="{{ request('search') }}">
                        <select name="sort_by" class="form-select ms-2">
                            <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="total_sales" {{ request('sort_by') === 'total_sales' ? 'selected' : '' }}>Sort by Total Sales</option>
                            <option value="total_revenue" {{ request('sort_by') === 'total_revenue' ? 'selected' : '' }}>Sort by Total Revenue</option>
                            <option value="transaction_count" {{ request('sort_by') === 'transaction_count' ? 'selected' : '' }}>Sort by Transactions</option>
                        </select>
                        <button class="btn btn-primary ms-2" type="submit">Apply</button>
                    </div>
                </form>
            </div>

            <!-- Reports Table -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Business Performance Report</h4>
                    @if($businesses->isEmpty())
                        <p class="text-muted">No reports available.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Business Name</th>
                                <th scope="col">Total Sales (N)</th>
                                <th scope="col">Total Revenue (N)</th>
                                <th scope="col">Number of Transactions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($businesses as $business)
                                <tr>
                                    <td>{{ $business->name }}</td>
                                    <td>{{ number_format($business->total_sales, 2) }}</td>
                                    <td>{{ number_format($business->total_revenue, 2) }}</td>
                                    <td>{{ $business->transaction_count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Custom Pagination -->
                        <div class="d-flex justify-content-center mt-4 mb-3">
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $businesses->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $businesses->previousPageUrl() }}" aria-label="Previous">Prev</a>
                                </li>

                                @php
                                    $start = max(1, $businesses->currentPage() - 3);
                                    $end = min($start + 6, $businesses->lastPage());
                                @endphp

                                @if($start > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $businesses->url(1) }}">1</a>
                                    </li>
                                    @if($start > 2)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $businesses->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $businesses->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if($end < $businesses->lastPage())
                                    @if($end < $businesses->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $businesses->url($businesses->lastPage()) }}">{{ $businesses->lastPage() }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ $businesses->onLastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $businesses->nextPageUrl() }}" aria-label="Next">Next</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
