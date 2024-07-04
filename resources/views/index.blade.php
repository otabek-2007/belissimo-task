<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('./css/show.css') }}">
    <title>Document</title>
</head>

<body>
    @include('layout.header')
    <div class="show-container">
        <div class="show-content">
            {{-- @foreach ($products as $product)
                @if ($product->is_pizza != 0) --}}
                    <div class="show-item-pizza">
                        <div class="item-img">
                            <img src="" alt="">
                        </div>
                        <div class="show-item-text">
                            <p class="show-item-title"></p>
                            <p class="show-item-description"></p>
                            <div class="show-item-price">
                                <p class="item-price">
                                    <span class="price"></span>
                                </p>
                            </div>
                        </div>
                        {{-- {{ $product }} --}}
                    </div>
                {{-- @endif
            @endforeach --}}
        </div>
    </div>
</body>

</html>
