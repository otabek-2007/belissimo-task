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
                <p class="description">{{ $bonus->description_uz }}</p>
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
                                {{-- <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 1024 1024" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z">
                                    </path>
                                </svg> --}}
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
    <div class="m">
        <div id="modal" class="modal">
            <div class="modal-content">
                <div class="modal-header-content">
                    <p id="modal-content-title"></p>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body-content">
                    <div class="modal-card-content">
                        <img id="modal-product-image" src="/image/pizz-modal.jpg" alt="Product Image">
                        <h2 id="modal-product-title"></h2>
                        <div class="check-icon">
                            <svg class="" stroke="currentColor" fill="currentColor" stroke-width="0"
                                viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="modal-card-content">
                        <img id="modal-product-image" src="/image/pizz-modal.jpg" alt="Product Image">
                        <h2 id="modal-product-title"></h2>
                        <div class="check-icon">
                            <svg class="" stroke="currentColor" fill="currentColor" stroke-width="0"
                                viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="modal-card-content">
                        <img id="modal-product-image" src="/image/pizz-modal.jpg" alt="Product Image">
                        <h2 id="modal-product-title"></h2>
                        <div class="check-icon">
                            <svg class="" stroke="currentColor" fill="currentColor" stroke-width="0"
                                viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="add-btn-box">
                    <button id="qoshish-btn" data-id="">Qo'shish</button>
                </div>
            </div>
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
                            "/image/pizz-modal.jpg");
                        $('#modal-content-title').text('Беллисстер 1');
                        $('#modal-product-title').text('Tovuqli');
                        $('#qoshish-btn').data('id', positionId);

                        $('#modal').show();
                        $('.m').addClass('active');
                        $('body').addClass('active');
                    },
                    error: function() {
                        alert('Failed to fetch data.');
                    }
                });
            });

            // Close modal
            $(document).on('click', '.close', function() {
                $('#modal').hide();
                $('.m').removeClass('active');
                $('body').removeClass('active');
            });

            // Close modal when clicking outside
            $(window).click(function(event) {
                if (event.target.id === 'modal') {
                    $('#modal').hide();
                    $('.m').removeClass('active');
                    $('body').removeClass('active');
                }
            });

            $(document).on('click', '.modal-card-content', function() {
                $('.modal-card-content').removeClass('active');
                $('#qoshish-btn').addClass('active')
                $(this).addClass('active');
            });
            $('#qoshish-btn').click(function() {
                $('#modal').hide();
                $('.m').removeClass('active');
                $('body').removeClass('active');
            })
        });
    </script>
</body>

</html>
