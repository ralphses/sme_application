@php use App\Models\Product; @endphp
<x-app-layout>

    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1">Welcome back, Admin!</h6>
                    <h5 class="mb-0">Here’s your product overview.</h5>
                </div>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
            </div>

            <!-- Search and Sort Bar -->
            <div class="mb-4">
                <form method="GET" action="{{ route('dashboard.products') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products by name" value="{{ $search }}">
                        <select name="sort_by" class="form-select ms-2">
                            <option value="name" {{ $sortBy === 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="price" {{ $sortBy === 'price' ? 'selected' : '' }}>Sort by Price</option>
                            <option value="quantity" {{ $sortBy === 'quantity' ? 'selected' : '' }}>Sort by Quantity</option>
                        </select>
                        <button class="btn btn-primary ms-2" type="submit">Apply</button>
                    </div>
                </form>
            </div>

            <!-- Product Management -->
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Product Management</h4>
                    @if($products->isEmpty())
                        <p class="text-muted">No products found.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price (N)</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Business Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->business->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Custom Pagination -->
                        <div class="d-flex justify-content-center mt-4 mb-3">
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $products->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">Prev</a>
                                </li>

                                @php
                                    $start = max(1, $products->currentPage() - 3);
                                    $end = min($start + 6, $products->lastPage());
                                @endphp

                                @if($start > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->url(1) }}">1</a>
                                    </li>
                                    @if($start > 2)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $products->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if($end < $products->lastPage())
                                    @if($end < $products->lastPage() - 1)
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">Next</a>
                                </li>
                            </ul>
                        </div>

                    @endif
                </div>
            </div><!--end card-->

        </div><!--end layout-specing-->
    </div><!--end container-->

</x-app-layout>
