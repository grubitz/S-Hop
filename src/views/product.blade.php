@extends('layout')

@section('content')
    <h1>{{ $product['name'] }}</h1>
    <p>${{ number_format($product['price'] / 100, 2) }}</p>
    <p>{{ $product['product_code'] }}</p>
@endsection
