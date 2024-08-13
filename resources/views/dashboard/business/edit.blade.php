@php use App\Models\Business; @endphp
<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Edit Business</h6>
                    <h5 class="mb-0">Update business details</h5>
                </div>
            </div>

            <!-- Edit Business Form -->
            <div class="card mt-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.business.update', $business->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Business Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $business->name) }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="active" {{ old('status', $business->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $business->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('dashboard.business') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
