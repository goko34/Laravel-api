<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route("products.home") }}">KLE</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle custom-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ session('username') }}
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route("logout")}}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
