<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/package.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <p class="title">Savat</p>
        @if (!$package)
            <div class="empty-box">
                <i class="fa-solid fa-chevron-left left-back"></i>
                <img src="https://intermenu.bellissimo.uz/static/media/empty-cart.d0b60c2da0f4ea5c6e8614d769021c8e.svg"
                    alt="">
                <p>Hozircha sizning savatchangiz boʻsh 😕</p>
            </div>
        @else
        <i class="fa-solid fa-chevron-left left-back"></i>
        <div class="show-package-items">
                <div class="package-item">

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
        });
    </script>
</body>

</html>
