<link rel="stylesheet" href="{{ asset('/css/stock-products.css') }}">

<div class="stock-container">
    @foreach ($products as $product)
        <div class="stock-item" data-id="{{ $product->id }}">
            <img src="{{ asset('image/' . ($product->image ? $product->image : 'pizza.jpg')) }}"
                alt="{{ $product->name }}">
            <div class="btn-container">
                <button>Setni yeg'ish</button>
            </div>
        </div>
    @endforeach
</div>

<script>
    $(document).ready(function() {
        $('.stock-item').click(function() {
            var productId = $(this).data('id');
            $.ajax({
                url: '/stock-product',
                method: 'GET',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    var newUrl = '/stock-product';
                    window.history.pushState({
                        path: newUrl
                    }, '', newUrl);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
