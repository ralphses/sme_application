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

            <!-- Metrics Cards -->
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card bg-light text-center">
                        <div class="card-body">
                            <h6 class="text-muted">Total Users</h6>
                            <p class="fs-4 text-dark fw-bold">{{ $data['total_users'] }}</p>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-3 mb-3">
                    <div class="card bg-light text-center">
                        <div class="card-body">
                            <h6 class="text-muted">Active Businesses</h6>
                            <p class="fs-4 text-dark fw-bold">{{ $data['active_businesses'] }}</p>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-3 mb-3">
                    <div class="card bg-light text-center">
                        <div class="card-body">
                            <h6 class="text-muted">Pending Orders</h6>
                            <p class="fs-4 text-dark fw-bold">{{ $data['pending_orders'] }}</p>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-3 mb-3">
                    <div class="card bg-light text-center">
                        <div class="card-body">
                            <h6 class="text-muted">Total Revenue</h6>
                            <p class="fs-4 text-dark fw-bold">N{{ number_format($data['total_revenue'], 2) }}</p>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->


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
                                    <td>{{ str_replace('_', ' ', ucfirst($user->role)) }}</td>
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
                        <a href="{{ route('dashboard.users') }}" class="btn btn-primary mt-2">View All Users</a>
                    @endif
                </div>
            </div><!--end card-->

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
                        <a href="#" class="btn btn-primary mt-2">View All Businesses</a>
                    @endif
                </div>
            </div><!--end card-->

            <!-- Recent Activities -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Recent Activities</h4>
                    @if($recent_activities->isEmpty())
                        <p class="text-muted">No recent activities found.</p>
                    @else
                        <ul class="list-group">
                            @foreach($recent_activities as $activity)
                                <li class="list-group-item">
                                    {{ $activity->description }}
                                    <span class="text-muted">- {{ $activity->created_at->format('F j, Y \a\t h:i A') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#" class="btn btn-primary mt-2">View All Activities</a>
                    @endif
                </div>
            </div><!--end card-->


        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
