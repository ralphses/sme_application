<x-app-layout>
    <x-top-header/>

    <div class="container-fluid">
        <div class="layout-specing">
            <h4>Create New Sales Order</h4>

            @if($products->isEmpty())
                <div class="alert alert-danger" role="alert">
                    Cannot create order now, Business owner is yet to add a product.
                </div>
            @else
                <form action="{{ route('dashboard.business.order.create') }}" method="POST">
                    @csrf

                    <!-- Product Selection -->
                    <div id="product-selection">
                        <div class="product-item mb-3">
                            <label for="product_id_0" class="form-label">Select Product</label>
                            <select id="product_id_0" name="products[0][product_id]" class="form-control" required>
                                <option value="" disabled selected>Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - ₦{{ number_format($product->price, 2) }}</option>
                                @endforeach
                            </select>

                            <!-- Quantity -->
                            <label for="quantity_0" class="form-label mt-2">Quantity</label>
                            <input type="number" id="quantity_0" name="products[0][quantity]" class="form-control" min="1" required>
                        </div>
                    </div>

                    <!-- Add Product Button -->
                    <button type="button" id="add-product" class="btn btn-secondary mb-3">Add Another Product</button>

                    <!-- Payment Method Selection -->
                    <div class="mb-3">
                        <label for="payment_method_id" class="form-label">Select Payment Method</label>
                        <select id="payment_method_id" name="payment_method_id" class="form-control" required>
                            <option value="" disabled selected>Select a payment method</option>
                            @foreach($paymentMethods as $method)
                                <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            @endif
        </div>
    </div>

    <!-- JavaScript to Handle Adding More Products -->
    <script>
        document.getElementById('add-product')?.addEventListener('click', function() {
            var productSelectionDiv = document.getElementById('product-selection');
            var productCount = productSelectionDiv.children.length;

            var newProductItem = document.createElement('div');
            newProductItem.className = 'product-item mb-3';

            newProductItem.innerHTML = `
                <label for="product_id_${productCount}" class="form-label">Select Product</label>
                <select id="product_id_${productCount}" name="products[${productCount}][product_id]" class="form-control" required>
                    <option value="" disabled selected>Select a product</option>
                    @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }} - ₦{{ number_format($product->price, 2) }}</option>
                    @endforeach
            </select>

            <!-- Quantity -->
            <label for="quantity_${productCount}" class="form-label mt-2">Quantity</label>
                <input type="number" id="quantity_${productCount}" name="products[${productCount}][quantity]" class="form-control" min="1" required>
            `;

            productSelectionDiv.appendChild(newProductItem);
        });
    </script>
</x-app-layout>
