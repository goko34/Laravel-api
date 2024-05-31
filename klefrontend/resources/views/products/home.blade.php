@extends('include.default')
@section('title',"Home Page")
@section('content')
    @include("include.header")
    <body>
        <!--List kısmı-->
        <div class="container table-responsive mt-5">
            @if (session()->has("success"))
                <div class="col-3">
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{session("success")}}
                    </div>
                </div>
            @endif
            <div class="text-end">
                <a href="{{route("products.create")}}" class="btn btn-success btn-md">Add Product</a>
            </div>
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Ürün Adı</th>
                        <th scope="col">Fiyatı</th>
                        <th scope="col">Açıklaması</th>
                        <th scope="col">Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <th scope="row" class="align-middle">{{$product['id']}}</th>
                        <td class="align-middle">{{$product['name']}}</td>
                        <td class="align-middle">{{$product['price']}}</td>
                        <td class="align-middle">{{$product['description']}}</td>
                        <td>
                            <a href="{{route("products.detail",$product['id'])}}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{route("products.edit",$product['id'])}}" class="btn btn-secondary btn-sm">Update</a>
                            <form method="POST" action="{{route("products.destroy",$product['id'])}}" type="button" class="btn btn-danger btn-sm p-0">
                                @csrf
                                @method("delete")
                                <input type="hidden" value="Delete">
                                <button type="submit" class="btn btn-danger btn-sm m-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </body>
@endsection

