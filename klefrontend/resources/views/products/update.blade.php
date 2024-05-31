@extends('include.default')
@section('title', "Update Page")
@section('content')
    @include("include.header")
    <div class="container mt-5">
        @if($errors->any())
            <div class="col-6">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{session('error')}}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{session('error')}}
            </div>
        @endif

        <form method="POST" action="{{ route('products.update', $product['id']) }}">
            @csrf
            @method('PUT')
            <div class="row justify-content-start">
                <div class="col-md-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product['name'] }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" value="{{ $product['price'] }}">
                </div>
            </div>
            <div class="row justify-content-start mt-3">
                <div class="col-md-6">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" value="{{ $product['description'] }}">
                </div>
            </div>
            <button class="btn btn-success mt-2" type="submit">Update</button>
        </form>
    </div>
@endsection
