@extends('include.default')
@section('title',"Add Product Page")
@section('content')
    @include("include.header")
    <div class="container mt-5">
        @if (session()->has("success"))
                <div class="col-3">
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{session("success")}}
                    </div>
                </div>
        @endif
        @if($errors->any())
            <div class="col-6">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{$error}}
                    </div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{route("products.store")}}">
            @csrf
            @method("post")
            <div class="row justify-content-start">
                <div class="col-md-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Price</label>
                    <input type="text" name="price" class="form-control">
                </div>
            </div>
            <div class="row justify-content-start mt-3">
                <div class="col-md-6">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
            </div>
            <button class="btn btn-success mt-2" type="submit">Add Product</button>
        </form>
    </div>
@endsection
