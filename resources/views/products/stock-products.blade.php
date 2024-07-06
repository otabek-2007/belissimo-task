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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).on('click', '.stock-item', function() {
        var productId = $(this).data('id');
        $.ajax({
            url: '/product/bonuses/' + productId,
            method: 'GET',
            success: function(response) {
                window.location.href = '/product/bonuses/' + productId; 
            },
            error: function(xhr) {
                console.error('An error occurred:', xhr.responseText);
            }
        });
    });
</script>
