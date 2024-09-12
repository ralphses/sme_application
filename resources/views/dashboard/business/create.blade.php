@php use App\Models\Business; @endphp
<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Create Business</h6>
                    <h5 class="mb-0">Add a new business</h5>
                </div>
            </div>

            <!-- Create Business Form -->
            <div class="card mt-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.business.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Business Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Business Location</label>
                            <textarea name="address" id="description" class="form-control">{{ old('address') }}</textarea>
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
