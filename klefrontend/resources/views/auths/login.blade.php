@extends('include.default')
@section('title', 'Login')
@section('content')

    <body class="bg-secondary">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mt-4">
                        @if ($errors->any())
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"aria-label="Close"></button>
                                         {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"aria-label="Close"></button>
                                    {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"maria-label="Close"></button>
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-header text-center">
                            Login
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form">
                                    <label class="form-label">if you haven't created an account yet</label>
                                    <a href="{{ route('register') }}">register-></a>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary mt-3" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
