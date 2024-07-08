<div class="alert-message">
    <span class="added-icon">📥</span>
    <span class="message-title">dwedw</span>
    <p>savatchaga qoshildi</p>
</div>
@php $firstCategory1 = true; @endphp

@foreach ($products as $product)
    @if ($firstCategory1 && $product->category_id == 1)
        <div class="show-pizza-content">
            <div class="cons-pizza">
                <span>👷</span>
                <p>Konstruktor</p>
                <div class="right-stright-yellow">
                    <span>→</span>
                </div>
            </div>
            <div class="half-pizza">
                <span>🌓</span>
                <p>50 ga 50</p>
                <div class="right-stright-blue">
                    <span>→</span>
                </div>
            </div>
        </div>
        @php $firstCategory1 = false; @endphp
    @endif
    @if ($product->category_id == 1)
        <div class="show-content">
            <div class="show-item-pizza">
                <div class="show-item-img">
                    <img src="{{ $product->image ? '/image/' . $product->image : '/image/default.jpg' }}"
                        alt="">
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

<div class="show-content-card-filtered">
    @foreach ($products as $product)
        @if ($product->category_id != 1)
            <div class="show-card">
                <div class="card-img">
                    <img src="{{ $product->image ? '/image/' . $product->image : '/image/default.jpg' }}"
                        alt="">

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
<div class="m">

    <div id="product-modal" class="modal">
        <div class="modal-content">
            <div class="drag-line"></div>
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

</div>

<script>
    $(document).ready(function() {
        var modal = $('#product-modal');
        var closeBtn = $('.close');
        var isDragging = false;
        var startPosition = 0;

        $('.item-add-btn').click(function() {
            var productId = $(this).data('id');

            $.ajax({
                url: '/show/product',
                method: 'GET',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    $('#modal-product-image').attr('src', response.image ? '/image/' +
                        response.image : '/image/default.jpg');
                    $('#modal-product-title').text(response.name_uz);
                    $('#modal-product-description').text(response.description_uz);
                    $('#modal-product-price').text((response.price_small ? response
                        .price_small : (response.price_medium ? response
                            .price_medium : response.price_big)) + ' so’m');
                    $('#qoshish-btn').data('id', productId).data('name', response.name_uz);

                    $('.m').addClass('active'); // Show the modal
                    $('body').addClass('active'); // Show the modal
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

        $(".cons-pizza").click(function() {
            window.location.href = '/products/construktor';
        });

        $(".half-pizza").click(function() {
            window.location.href = '/show/half-pizza';
        });

        $(window).click(function(event) {
            if (event.target == modal[0]) {
                closeModal();
            }
        });

        $('#qoshish-btn').click(function() {
            var productId = $(this).data('id');
            var productName = $(this).data('name');

            $.ajax({
                url: '/add/product',
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    showAlertMessage(productName);
                    closeModal();
                },
                error: function(xhr, status, error) {
                    closeModal();
                }
            });
        });

        function closeModal() {
            $('.m').removeClass('active'); // Hide the modal
            $('body').removeClass('active'); // Hide the modal
            modal.css('bottom', '-100%');
        }

        function showAlertMessage(productName) {
            var alertMessage = $('.alert-message');
            alertMessage.find('.message-title').text(productName);
            alertMessage.addClass('active');

            setTimeout(function() {
                alertMessage.removeClass('active');
            }, 3000); // Adjust the timeout duration as needed
        }

        $(window).on('click', function(event) {
            if ($(event.target).closest('.modal-content').length === 0 && $(event.target).closest(
                    '.item-add-btn').length === 0) {
                closeModal();
            }
        });

        $('.drag-line').on('mousedown touchstart', function(e) {
            isDragging = true;
            startPosition = e.pageY || e.originalEvent.touches[0].pageY;
        });

        $(window).on('mousemove touchmove', function(e) {
            if (!isDragging) return;
            var currentPosition = e.pageY || e.originalEvent.touches[0].pageY;
            var difference = currentPosition - startPosition;

            if (difference > 0) {
                modal.css('bottom', -difference + 'px');
            }
        });

        $(window).on('mouseup touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;

            var endPosition = e.pageY || e.originalEvent.changedTouches[0].pageY;
            var difference = endPosition - startPosition;

            if (difference > 50) {
                closeModal();
            } else {
                modal.css('bottom', '0');
            }
        });
    });
</script>
