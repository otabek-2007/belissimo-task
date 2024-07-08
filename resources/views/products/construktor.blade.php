<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('./css/construktor.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <p class="title">Savat</p>
        <i class="fa-solid fa-chevron-left left-back"></i>
        <div class="header-banner">
            
        </div>
        <div class="size-pizza">
            <p>Pitsa kattaligi</p>
            <div class="select-size">
                <div class="small-size active">
                    <p>Kichkina</p>
                </div>
                <div class="medium-size">
                    <p>Ortacha</p>
                </div>
                <div class="big-size">
                    <p>Katta</p>
                </div>
            </div>
        </div>
        <div class="size-pizza-first active">
            <p>Bortni tanlang</p>
            <div class="select-size-first">
                <div class="small-size active">
                    <p>Qalin</p>
                </div>
            </div>
        </div>
        <div class="size-pizza-second">
            <p>Bortni tanlang</p>
            <div class="select-size-second">
                <div class="small-size-second active">
                    <p>Qalin</p>
                </div>
                <div class="medium-size-second">
                    <p>Yupqa</p>
                </div>
                <div class="big-size-second">
                    <p>Hot-Dog Bort</p>
                </div>
            </div>
        </div>
        <div class="size-pizza-three">
            <p>Bortni tanlang</p>
            <div class="select-size-three">
                <div class="small-size-three active">
                    <p>Qalin</p>
                </div>
                <div class="medium-size-three">
                    <p>Hot-Dog Bort</p>
                </div>
                <div class="big-size-three">
                    <p>Yupqa</p>
                </div>
            </div>
        </div>
        <div class="show-filter-products">
            @foreach ($construktor as $item)
                <div class="filter-product">
                    <img src="/image/default.jpg" alt="">
                    <p>{{ $item->name_uz }}</p>
                    <span>{{ $item->price }}</span>
                    <div class="add-btn">
                        <svg width="12" class="active-add-plus" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 6.01004C12 6.56233 11.5523 7.01205 11 7.01205H7V11.0201C7 11.5724 6.55228 12.0201 6 12.0201C5.44772 12.0201 5 11.5724 5 11.0201V7.01205H1C0.447715 7.01205 0 6.56233 0 6.01004C0 5.45776 0.447715 5.00803 1 5.00803H5V1C5 0.447716 5.44772 0 6 0C6.55228 0 7 0.447715 7 1V5.00803H11C11.5523 5.00803 12 5.45776 12 6.01004Z"
                                fill="black"></path>
                        </svg>
                        <svg width="15" class="active-add" height="11" viewBox="0 0 15 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.59701 8.70149L1.14925 5.25373L0 6.40299L4.59701 11L14.4478 1.14925L13.2985 0L4.59701 8.70149Z"
                                fill="white"></path>
                        </svg>
                    </div>
                </div>
            @endforeach
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
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.left-back').click(function() {
                window.location.href = '/index?category_id=1';
            });

            $('.add-btn').click(function() {
                $(this).find('.active-add-plus, .active-add').toggleClass('active');

                $(this).toggleClass('active')
            });

            $('.small-size').click(function() {
                $('.select-size div').removeClass('active')
                $('.size-pizza-first').addClass('active')
                $('.size-pizza-second').removeClass('active')
                $('.size-pizza-three').removeClass('active')
                $(this).addClass('active');
                $.ajax({
                    url: '/products/construktor',
                    data: {
                        small: 1
                    },
                    method: 'GET',
                    success: function(response) {
                        var newUrl = '/products/construktor';
                    },
                    error: function(xhr, status, error) {}
                });
            });
            $('.select-size-first div').click(function() {
                $('.select-size-first div').removeClass('active')
                $(this).addClass('active');
            })
            $('.select-size-second div').click(function() {
                $('.select-size-second div').removeClass('active')
                $(this).addClass('active');
            })
            $('.select-size-three div').click(function() {
                $('.select-size-three div').removeClass('active')
                $(this).addClass('active');
            })
            $('.medium-size').click(function() {
                $('.select-size div').removeClass('active')
                $('.size-pizza-first').removeClass('active')
                $('.size-pizza-second').addClass('active')
                $('.size-pizza-three').removeClass('active')
                $(this).addClass('active');
                $.ajax({
                    url: '/products/construktor',
                    method: 'GET',
                    data: {
                        medium: 1
                    },
                    success: function(response) {
                        var newUrl = '/products/construktor';
                    },
                    error: function(xhr, status, error) {}
                });
            });
            $('.big-size').click(function() {
                $('.select-size div').removeClass('active')
                $('.size-pizza-first').removeClass('active')
                $('.size-pizza-second').removeClass('active')
                $('.size-pizza-three').addClass('active')
                $(this).addClass('active');
                $.ajax({
                    url: '/products/construktor',
                    method: 'GET',
                    data: {
                        big: 1
                    },
                    success: function(response) {
                        var newUrl = '/products/construktor';
                    },
                    error: function(xhr, status, error) {}
                });
            });
        });
    </script>

</body>

</html>
