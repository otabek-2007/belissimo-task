<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Show Page</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="{{ asset('/css/stock-show.css') }}">
</head>

<body>
    <div class="container">
        <div class="stock-img">
            <img src="{{ asset('image/' . ($bonus->photo ? $bonus->photo : 'pizza-stock.jpg')) }}"
                alt="{{ $bonus->name_uz }}">
        </div>
        <pre>
            <small>
        {{ $bonus }}

            </small>
        </pre>
        <div class="bonus-container">
            <div class="bonus-title">
                <p class="name">{{ $bonus->name_uz }}</p>
                <p class="description">{{ $bonus->description_uz }}</p>
            </div>
            <div class="bonus-cards">
                @foreach ($bonus->bonusItems as $item)
                    <div class="bonus-card">
                        <div class="card-title">
                            <span>Tanlash</span>
                            <p>{{ $item->name_uz }}</p>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script></script>
</body>

</html>
