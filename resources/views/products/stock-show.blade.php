<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Show Page</title>
    <link rel="stylesheet" href="{{ asset('/css/stock-show.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        body.blur {
            backdrop-filter: blur(2px);
            background: rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="stock-img">
            <img src="{{ asset('image/' . ($bonus->photo ? $bonus->photo : 'pizza-stock.jpg')) }}"
                alt="{{ $bonus->name_uz }}">
        </div>
        <i class="fa-solid fa-chevron-left left-back"></i>
        <div class="bonus-container">
            <div class="bonus-title">
                <p class="name">{{ $bonus->name_uz }}</p>
                <p class="description">{{ $bonus->description_uz }}"></p>
            </div>
            <div class="bonus-cards">
                @if ($bonus->bonusItems)
                    @foreach ($bonus->bonusItems as $item)
                        <div class="bonus-card" data-id="{{ $item->position_id }}">
                            <div class="card-title">
                                <span>Tanlash</span>
                                <p>{{ $item->name_ru }}</p>
                            </div>
                            <div class="card-link">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512"
                                    class="ListSelectProducts_arrow__jWKGU" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No bonus items available.</p>
                @endif

            </div>
        </div>
        <div class="footer">
            <div class="pay-box">
                <span>75 000 so'm</span>
                <div class="pay-btn">
                    <p>Qo'shish</p>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modal-product-image" src="/image/image.png" alt="Product Image">
            <h2 id="modal-product-title">Product Title</h2>
            <p id="modal-product-description">Product Description</p>
            <p id="modal-product-price">Price</p>
            <button id="qoshish-btn" data-id="">Qo'shish</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var bonusId = @json($bonus->id);
    </script>
    <script>
        $(document).ready(function() {
            $('.left-back').click(function() {
                window.location.href = '/index?in_stock=true';
            });

            $('.bonus-card').click(function() {
                var positionId = $(this).data('id');
                $.ajax({
                    url: '/product/bonuses/' + bonusId,
                    method: 'GET',
                    data: {
                        position_id: positionId
                    },
                    success: function(response) {
                        $('#modal-product-image').attr('src', response.image ? response.image :
                            "/image/image.png");
                        $('#modal-product-title').text(response.name_uz);
                        $('#modal-product-description').text(response.description_uz);
                        $('#modal-product-price').text((response.price_small ? response
                            .price_small : (response.price_medium ? response
                                .price_medium : response.price_big)) + ' so’m');
                        $('#qoshish-btn').data('id', positionId);

                        $('body').addClass('modal-open');
                        $('#modal').show();
                        $('body').addClass('blur');
                    },
                    error: function() {
                        alert('Failed to fetch data.');
                    }
                });
            });


            // Close modal
            $(document).on('click', '.close', function() {
                $('#modal').hide();
                $('body').removeClass('blur');
            });

            // Close modal when clicking outside
            $(window).click(function(event) {
                if (event.target.id === 'modal') {
                    $('#modal').hide();
                    $('body').removeClass('blur');
                }
            });
        });
    </script>
</body>

</html>
