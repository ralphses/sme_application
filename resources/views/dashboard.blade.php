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
                            <p class="fs-4 text-dark fw-bold">0</p>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-3 mb-3">
                    <div class="card bg-light text-center">
                        <div class="card-body">
                            <h6 class="text-muted">Active Businesses</h6>
                            <p class="fs-4 text-dark fw-bold">0</p>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-3 mb-3">
                    <div class="card bg-light text-center">
                        <div class="card-body">
                            <h6 class="text-muted">Pending Orders</h6>
                            <p class="fs-4 text-dark fw-bold">0</p>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-3 mb-3">
                    <div class="card bg-light text-center">
                        <div class="card-body">
                            <h6 class="text-muted">Total Revenue</h6>
                            <p class="fs-4 text-dark fw-bold">0</p>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->


            <!-- User Management -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>User Management</h4>
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
{{--                        @foreach($users as $user)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $user->name }}</td>--}}
{{--                                <td>{{ $user->email }}</td>--}}
{{--                                <td>{{ ucfirst($user->role) }}</td>--}}
{{--                                <td>{{ $user->status }}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>--}}
{{--                                    <a href="{{ route('admin.deleteUser', $user->id) }}" class="btn btn-danger btn-sm">Delete</a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div><!--end card-->

            <!-- Business Management -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Business Management</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Business Name</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($businesses as $business)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $business->name }}</td>--}}
{{--                                <td>{{ $business->owner->name }}</td>--}}
{{--                                <td>{{ $business->status }}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('admin.editBusiness', $business->id) }}" class="btn btn-warning btn-sm">Edit</a>--}}
{{--                                    <a href="{{ route('admin.deleteBusiness', $business->id) }}" class="btn btn-danger btn-sm">Delete</a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div><!--end card-->

            <!-- Recent Activities -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Recent Activities</h4>
                    <ul class="list-group">
{{--                        @foreach($recent_activities as $activity)--}}
{{--                            <li class="list-group-item">--}}
{{--                                {{ $activity['description'] }} <span class="text-muted">- {{ $activity['time'] }}</span>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
                    </ul>
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
