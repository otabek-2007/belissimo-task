<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="header-container">
        <div class="header-cards">
            @foreach ($categories as $category)
                <div class="card{{ $category->id === 1 ? ' active' : '' }}" data-id="{{ $category->id }}">
                    <span>🍕</span>
                    <p>{{ $category->name_uz }}</p>
                </div>
            @endforeach
        </div>
        <div class="menu-cards">
            <div class="menu-card">
                <span>🎉</span>
                <div>
                    <p class="status">Yangi</p>
                    <p class="new">Aksiyalar</p>
                </div>
            </div>
            <div class="menu-card-package">
                <div>
                    <p class="status">Savat</p>
                    <p class="new"><span class="count">dona</span></p>
                </div>
                <span>🛒</span>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.card').click(function() {
                var categoryId = $(this).data('id');

                $('.card').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    url: '/index',
                    method: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        var newUrl = '/index?category_id=' + categoryId;
                        window.history.pushState({
                            path: newUrl
                        }, '', newUrl);
                        $('#filtered-products').html(response.html);
                        $('#stock-products').html('');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('.menu-card').click(function() {
                $('.card').removeClass('active');
                $('.menu-card').addClass('active');

                $.ajax({
                    url: '/index',
                    method: 'GET',
                    data: {
                        in_stock: true
                    },
                    success: function(response) {
                        var newUrl = '/index?in_stock=true';
                        window.history.pushState({
                            path: newUrl
                        }, '', newUrl);
                        $('#stock-products').html(response.html);
                        $('#filtered-products').html('');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $('.menu-card-package').click(function() {
                window.location.href = '/package/page';
            });
        });
    </script>


</body>

</html>
