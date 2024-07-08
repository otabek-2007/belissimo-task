<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('./css/50_50pizza.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <p class="title">50 ga 50 pitsa</p>
        <i class="fa-solid fa-chevron-left left-back"></i>
        <div class="header-banner">
            <div class="show-pizza-img-left">
                <img src="/image/half-pizza-1.jpg" alt="">
            </div>
            <div class="show-pizza-img-right">
                <img src="/image/half-pizza-2.jpg" alt="">
            </div>
        </div>
        <div class="select-pizza">
            <div class="choose-box">
                <p>Chap yarmi</p>
                <div class="choose-pizza first-box">
                    <p>de</p>
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.41421 0C0.523309 0 0.0771422 1.07714 0.707107 1.70711L4.29289 5.29289C4.68342 5.68342 5.31658 5.68342 5.70711 5.29289L9.29289 1.70711C9.92286 1.07714 9.47669 0 8.58579 0H1.41421Z"
                            fill="black"></path>
                    </svg>
                </div>
            </div>
            <div class="choose-box">
                <p>O'ng yarmi</p>
                <div class="choose-pizza second-box">
                    <p>de</p>
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.41421 0C0.523309 0 0.0771422 1.07714 0.707107 1.70711L4.29289 5.29289C4.68342 5.68342 5.31658 5.68342 5.70711 5.29289L9.29289 1.70711C9.92286 1.07714 9.47669 0 8.58579 0H1.41421Z"
                            fill="black"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="size-pizza">
            <p>Pitsa kattalig</p>
            <div class="select-size">
                <div class="big-size">
                    <p>Katta</p>
                </div>
            </div>
        </div>
        <div class="size-pizza-three">
            <p>Bortni tanlang</p>
            <div class="select-size-three">
                <div class="small-size-three active">
                    <p>Qalin</p>
                </div>
                <div class="big-size-three">
                    <p>Yupqa</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="pay-box">
            <span class="total-price">321 000 so'm</span>
            <div class="pay-btn">
                <p>Qo'shish</p>
                <span class="total-amount"></span>
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
                    @foreach ($halfPizzas as $pizza)
                        <div class="modal-card-content">
                            <img id="modal-product-image" src="/image/pizz-modal.jpg" alt="Product Image">
                            <h2 id="modal-product-title">{{ $pizza->name_uz }}</h2>
                            <div class="check-icon">
                                <svg class="" stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 16 16" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                    <div class="qoshish-add">qoshish</div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".select-size-three div").click(function() {
                $(".select-size-three div").removeClass('active');
                $(this).addClass('active');
            });
            $('.left-back').click(function() {
                window.location.href = '/index?category_id=1';
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
        });
    </script>

</body>


</html>