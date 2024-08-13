@php use App\Models\Business; @endphp
<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, Admin!</h6>
                    <h5 class="mb-0">Here’s your business overview.</h5>
                </div>
            </div>

            <!-- Search and Sort Bar -->
            <div class="mb-4">
                <form method="GET" action="{{ route('dashboard.business') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search businesses by name" value="{{ $search }}">
                        <select name="sort_by" class="form-select ms-2">
                            <option value="name" {{ $sortBy === 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="status" {{ $sortBy === 'status' ? 'selected' : '' }}>Sort by Status</option>
                        </select>
                        <button class="btn btn-primary ms-2" type="submit">Apply</button>
                    </div>
                </form>
            </div>

            <!-- Business Management -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Business Management</h4>
                    @if($businesses->isEmpty())
                        <p class="text-muted">No businesses found.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($businesses as $business)
                                <tr>
                                    <td>{{ $business->name }}</td>
                                    <td>{{ $business->user->name }}</td>
                                    <td>{{ ucfirst($business->status) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('dashboard.business.updateStatus', $business->id) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-{{ $business->status === 'active' ? 'danger' : 'success' }} btn-sm">
                                                {{ $business->status === 'active' ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Custom Pagination -->
                        <div class="d-flex justify-content-center mt-4 mb-3">
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $businesses->currentPage() == 1 ? 'disabled' : '' }}">
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

                                <li class="page-item {{ $businesses->currentPage() == $businesses->lastPage() ? 'disabled' : '' }}">
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
