<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('/css/package.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <p class="title">Savat</p>

        @if ($packages->isEmpty() && $halfPackages->isEmpty())
            <div class="empty-box">
                <i class="fa-solid fa-chevron-left left-back"></i>
                <img src="https://intermenu.bellissimo.uz/static/media/empty-cart.d0b60c2da0f4ea5c6e8614d769021c8e.svg"
                    alt="">
                <p>Hozircha sizning savatchingiz boʻsh 😕</p>
            </div>
        @else
            <i class="fa-solid fa-chevron-left left-back"></i>
            <div class="show-package-items">
                @foreach ($packages as $item)
                    <div class="item">
                        <div class="package-item">
                            <div class="package-item-img">
                                <img src="{{ $item->image ? '/image/' . $item->image : '/image/default.jpg' }}"
                                    alt="">

                                <div class="package-text">
                                    <p>{{ $item->name_uz }}</p>
                                    <span>{{ $item->description }}</span>
                                </div>
                            </div>
                            <div class="calculate-counter">
                                <div class="counter">
                                    <i class="fa-solid fa-minus minus-btn" data-id="{{ $item->product_id }}"
                                        data-price="{{ $item->price }}"></i>
                                    <span class="quantity">{{ $item->quantity }}</span>
                                    <i class="fa-solid fa-plus plus-btn" data-id="{{ $item->product_id }}"
                                        data-price="{{ $item->price }}"></i>
                                </div>
                                <div class="sum-item">
                                    <span class="total-price">{{ $item->price * $item->quantity }} so’m</span>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                    </div>
                @endforeach
                @foreach ($halfPackages as $item)
                    <div class="item">
                        <div class="package-item">
                            <div class="package-item-img">
                                <img src="{{ $item->image ? '/image/' . $item->image : '/image/default.jpg' }}"
                                    alt="">

                                <div class="package-text">
                                    <p>50 ga 50 pitsa</p>
                                    <span>{{ $item->name_uz_one }} + {{ $item->name_uz_two }}</span>
                                </div>
                            </div>
                            <div class="calculate-counter">
                                <div class="counter">
                                    <i class="fa-solid fa-minus minus-btn-half" data-id="{{ $item->id }}"
                                        data-price="{{ $item->price }}"></i>
                                    <span class="quantity">{{ $item->quantity }}</span>
                                    <i class="fa-solid fa-plus plus-btn-half" data-id="{{ $item->id }}"
                                        data-price="{{ $item->price }}"></i>
                                </div>
                                <div class="sum-item">
                                    <span class="total-price">{{ $item->price * $item->quantity }} so’m</span>
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                    </div>
                @endforeach

                <div class="promocode">
                    <p>Promo kod</p>
                    <div class="inputs">
                        <input type="text" placeholder="Promo Kod" class="promo-inp">
                        <input type="button" value="Qo'llash" class="support-btn">
                    </div>
                    <div class="error-alert">
                        <p>Promokodni kiritishda xato, tizimga kirishingiz kerak!</p>
                    </div>
                </div>
            </div>
            <div class="bottom-section">
                <div class="yetkazib-berish">
                    <div class="yetkazish">
                        <p>Yetkazib berish</p>
                        <p>Tekin</p>
                    </div>
                    <div class="sum-all">
                        <p>Umumiy narx</p>
                        <span class="total-amount"></span>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="pay-box">
                    <div class="pay-btn">
                        <p>Buyurtma qilish</p>
                        <span class="total-amount"></span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.left-back').click(function() {
                window.location.href = '/index';
            });

            $('.support-btn').click(function() {
                if ($('.promo-inp').val().trim() !== "") {
                    $('.error-alert').addClass('active');
                }
            });

            $('.plus-btn').click(function() {
                var itemId = $(this).data('id'); // Use 'id' for PackageHalf items
                var itemPrice = parseFloat($(this).data('price'));
                var quantityElement = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantityElement.text());

                $.ajax({
                    url: '/add/product',
                    method: 'POST',
                    data: {
                        product_id: itemId, // Adjust for Package items
                        quantity: currentQuantity + 1,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        quantityElement.text(currentQuantity + 1);
                        var newTotalPrice = itemPrice * (currentQuantity + 1);
                        quantityElement.closest('.calculate-counter').find('.total-price').text(
                            newTotalPrice + ' so’m');
                        updateTotalAmount();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('.minus-btn').click(function() {
                var itemId = $(this).data('id'); // Use 'id' for PackageHalf items
                var itemPrice = parseFloat($(this).data('price'));
                var quantityElement = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantityElement.text());

                if (currentQuantity > 0) {
                    var newQuantity = currentQuantity - 1;

                    $.ajax({
                        url: '/add/product',
                        method: 'POST',
                        data: {
                            product_id: itemId, // Adjust for Package items
                            quantity: newQuantity,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (newQuantity === 0) {
                                quantityElement.closest('.item').remove();
                            } else {
                                quantityElement.text(newQuantity);
                                var newTotalPrice = itemPrice * newQuantity;
                                quantityElement.closest('.calculate-counter').find(
                                    '.total-price').text(newTotalPrice + ' so’m');
                            }
                            updateTotalAmount();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });
            $('.plus-btn-half').click(function() {
                var itemId = $(this).data('id'); // Use 'id' for PackageHalf items
                var itemPrice = parseFloat($(this).data('price'));
                var quantityElement = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantityElement.text());

                $.ajax({
                    url: '/half/save',
                    method: 'POST',
                    data: {
                        product_id: itemId, // Adjust for Package items
                        quantity: currentQuantity + 1,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        quantityElement.text(currentQuantity + 1);
                        var newTotalPrice = itemPrice * (currentQuantity + 1);
                        quantityElement.closest('.calculate-counter').find('.total-price').text(
                            newTotalPrice + ' so’m');
                        updateTotalAmount();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('.minus-btn-half').click(function() {
                var itemId = $(this).data('id'); // Use 'id' for PackageHalf items
                var itemPrice = parseFloat($(this).data('price'));
                var quantityElement = $(this).siblings('.quantity');
                var currentQuantity = parseInt(quantityElement.text());

                if (currentQuantity > 0) {
                    var newQuantity = currentQuantity - 1;

                    $.ajax({
                        url: '/half/save',
                        method: 'POST',
                        data: {
                            product_id: itemId, // Adjust for Package items
                            quantity: newQuantity,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (newQuantity === 0) {
                                quantityElement.closest('.item').remove();
                            } else {
                                quantityElement.text(newQuantity);
                                var newTotalPrice = itemPrice * newQuantity;
                                quantityElement.closest('.calculate-counter').find(
                                    '.total-price').text(newTotalPrice + ' so’m');
                            }
                            updateTotalAmount();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });

            function updateTotalAmount() {
                var totalAmount = 0;
                $('.total-price').each(function() {
                    totalAmount += parseFloat($(this).text());
                });
                $('.yetkazib-berish .total-amount, .footer .total-amount').text(totalAmount + ' so’m');
            }

            updateTotalAmount();
        });
    </script>
</body>

</html>
