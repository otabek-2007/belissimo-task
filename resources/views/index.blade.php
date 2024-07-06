<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <title>Show Products</title>
</head>

<body>
    @include('layouts.header')

    <div id="filtered-products">
        @if (request()->has('category_id') && !empty($products))
            @include('products.filtered-products', ['products' => $products])
        @endif
    </div>

    <div id="stock-products">
        @if (request()->has('in_stock') && !empty($products))
            @include('products.stock-products', ['products' => $products])
        @endif
    </div>
</body>

</html>
