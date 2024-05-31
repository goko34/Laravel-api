@extends('include.default')
@section('title',"Detail Page")
@section('content')
    @include("include.header")
    <div class="container mt-5">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="col-3">#</th>
                <th scope="col" class="col-3">Ürün Bilgileri</th>
            </tr>
            </thead>
            <tbody>
            <form method="POST" action="{{route("products.detail", $product['id'])}}">
                @csrf
                @method("put")
                <tr>
                    <th scope="row" class="col">ID</th>
                    <td>{{$product['id']}}</td>
                </tr>
                <tr>
                    <th scope="row" class="col">Ürün Adı</th>
                    <td>{{$product['name']}}</td>
                </tr>
                <tr>
                    <th scope="row" class="col">Ürün Fiyatı</th>
                    <td>{{$product['price']}}</td>
                </tr>
                <tr>
                    <th scope="row" class="col">Ürün Açıklaması</th>
                    <td>{{$product['description']}}</td>
                </tr>
                </tbody>
            </form>

        </table>
    </div>
@endsection


