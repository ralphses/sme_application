<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, {{ Auth::user()->name }}!</h6>
                    <h5 class="mb-0">Employee Overview</h5>
                </div>
                <a href="{{ route('dashboard.employee.add') }}" class="btn btn-primary">Add New Employee</a>
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Search and Sort Form -->
            <div class="card mt-3">
                <div class="card-body">
                    <form method="GET" action="{{ route('dashboard.employee') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <select class="form-select" name="sort_by">
                                    <option value="">Sort By</option>
                                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="role" {{ request('sort_by') == 'role' ? 'selected' : '' }}>Role</option>
                                    <option value="business" {{ request('sort_by') == 'business' ? 'selected' : '' }}>Business</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </div>
                    </form>

                    <!-- Employees List -->
                    <h4>Employees List</h4>
                    @if($employees->isEmpty())
                        <p class="text-muted">No employees found.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Employee ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Business</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->user->name ?? 'N/A' }}</td>
                                    <td>{{ $employee->user->email ?? 'N/A' }}</td>
                                    <td>{{ $employee->user->role ?? 'N/A' }}</td>
                                    <td>{{ $employee->business->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4 mb-3">
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $employees->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $employees->previousPageUrl() }}" aria-label="Previous">Prev</a>
                                </li>

                                @php
                                    $start = max(1, $employees->currentPage() - 3);
                                    $end = min($start + 6, $employees->lastPage());
                                @endphp

                                @if($start > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $employees->url(1) }}">1</a>
                                    </li>
                                    @if($start > 2)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $employees->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $employees->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if($end < $employees->lastPage())
                                    @if($end < $employees->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $employees->url($employees->lastPage()) }}">{{ $employees->lastPage() }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ $employees->currentPage() == $employees->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $employees->nextPageUrl() }}" aria-label="Next">Next</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
