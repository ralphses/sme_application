@php use App\Models\User; @endphp
<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, Admin!</h6>
                    <h5 class="mb-0">Here’s your system overview.</h5>
                </div>
            </div>

            <!-- Search and Sort Bar -->
            <div class="mb-4">
                <form method="GET" action="{{ route('dashboard.users') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search users by name" value="{{ $search }}">
                        <select name="sort_by" class="form-select ms-2">
                            <option value="name" {{ $sortBy === 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="role" {{ $sortBy === 'role' ? 'selected' : '' }}>Sort by Role</option>
                            <option value="status" {{ $sortBy === 'status' ? 'selected' : '' }}>Sort by Status</option>
                        </select>
                        <button class="btn btn-primary ms-2" type="submit">Apply</button>
                    </div>
                </form>
            </div>

            <!-- User Management -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>User Management</h4>
                    @if($users->isEmpty())
                        <p class="text-muted">No users found.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ ucfirst($user->status) }}</td>
                                    <td>
                                        <form action="{{ route('dashboard.users.updateStatus', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : 'btn-success' }}">
                                                {{ $user->status === 'active' ? 'Suspend' : 'Activate' }}
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
                                <li class="page-item {{ $users->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">Prev</a>
                                </li>

                                @php
                                    $start = max(1, $users->currentPage() - 3);
                                    $end = min($start + 6, $users->lastPage());
                                @endphp

                                @if($start > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->url(1) }}">1</a>
                                    </li>
                                    @if($start > 2)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if($end < $users->lastPage())
                                    @if($end < $users->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">Next</a>
                                </li>
                            </ul>
                        </div>

                    @endif
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
