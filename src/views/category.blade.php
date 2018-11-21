@extends('layout')

@section('meta')
    <meta name='category-id' content="{{ $category['id'] }}"/>
@endsection

@section('content')
    <h1>{{ $category['name'] }}</h1>
    <table>
        @foreach ($products as $index => $product)
            <tr>
                <td>{{ ($index+1) }}</td>
                <td><a href="/p/{{ $product['id'] }}">{{ $product['name'] }}</a></td>
                <td>${{ number_format($product['price'] / 100, 2) }}</td>
            </tr>
        @endforeach
    </table>
@endsection
