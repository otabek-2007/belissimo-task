@foreach ($products as $product)
    @if ($product->category_id == 1)
        <div class="show-content">
            <div class="show-item-pizza">
                <div class="show-item-img">
                    <img src="/image/image.png" alt="" class="item-img">
                </div>
                <div class="show-item-text">
                    <p class="show-item-title">{{ $product->name_uz }}</p>
                    <p class="show-item-description">{{ $product->description_uz }}</p>
                    <div class="show-item-price">
                        <p class="item-price">
                            <span class="price">{{ $product->price_small }}</span> so’m
                        </p>
                        <div class="item-add-btn" data-id="{{ $product->id }}">+</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

{{-- Display products with category_id != 0 --}}
<div class="show-content-card-filtered">
    @foreach ($products as $product)
        @if ($product->category_id != 0)
            <div class="show-card">
                <div class="card-img">
                    <img src="./image/image.png" alt="">
                </div>
                <p class="card-title">{{ $product->name_uz }}</p>
                <p class="card-price"><span class="price-item">
                        @if ($product->price_small != 0)
                            {{ $product->price_small }}
                        @elseif($product->price_small == 0 || $product->price_medium != 0)
                            {{ $product->price_medium }}
                        @else
                            {{ $product->price_big }}
                        @endif
                    </span> so’m</p>
                <div class="item-add-btn add-btn" data-id="{{ $product->id }}">
                    Qo‘shish
                </div>
            </div>
        @endif
    @endforeach
</div>

{{-- Modal Structure --}}
<div id="product-modal" class="modal">
    <div class="modal-content">
        <div id="pizza_more">
            <div class="ProductMore_imageContainer">
                <img src="" alt="" class="ProductMore_image" id="modal-product-image">
            </div>
            <div class="ProductMore_details">
                <h2 class="ProductMore_title" id="modal-product-title"></h2>
                <p class="ProductMore_description" id="modal-product-description"></p>
            </div>
            <div class="ProductMore_actions ProductMore_buttonActions">
                <div class="ProductMore_priceAndAction">
                    <div class="ProductMore_price" id="modal-product-price"></div>
                    <button class="ProductMore_action" id="qoshish-btn">Qo'shish</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var modal = $('#product-modal');
        var closeBtn = $('.close');

        $('.item-add-btn').click(function() {
            var productId = $(this).data('id');

            $.ajax({
                url: '/show/product',
                method: 'GET',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    $('#modal-product-image').attr('src', response.image);
                    $('#modal-product-title').text(response.name);
                    $('#modal-product-description').text(response.description);
                    $('#modal-product-price').text(response.price + ' so’m');
                    $('#qoshish-btn').data('id', productId);

                    $('body').addClass('modal-open');
                    modal.css('display', 'block');
                    modal.css('bottom', '0');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product details:', error);
                }
            });
        });

        closeBtn.click(function() {
            closeModal();
        });

        $(window).click(function(event) {
            if (event.target == modal[0]) {
                closeModal();
            }
        });

        $('#qoshish-btn').click(function() {
            var productId = $(this).data('id');

            $.ajax({
                url: '/add/product',
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Product added:', response.message);
                    closeModal();
                },
                error: function(xhr, status, error) {
                    console.error('Error adding product:', error);
                    closeModal();
                }
            });
        });

        function closeModal() {
            $('body').removeClass('modal-open');
            modal.css('bottom', '-100%');
            setTimeout(function() {
                modal.css('display', 'none');
            }, 500);
        }
    });
</script>