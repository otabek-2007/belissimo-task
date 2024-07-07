@if ($products && count($products) > 0)
    @foreach ($products as $product)
        <div class="product-item">
            <p>{{ $product->name }}</p>
        </div>
    @endforeach
@else
    <p>No products available for this bonus item.</p>
@endif
