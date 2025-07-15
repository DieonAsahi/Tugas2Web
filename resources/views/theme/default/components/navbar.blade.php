<div>
    <nav class="navbar navbar-expand-lg fixed-top border-bottom" style="background: linear-gradient(90deg, #ffffffff 0%, #0a3264ff 100%);">
        <div class="container">
            <a class="navbar-brand text-white" href="/">
                <img src="{{ asset('storage/uploads/assets/ColorArt Hijau.png') }}" alt="Logo" width="90" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" aria-current="page" href="/" style="color: #3D74B6;">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/categories" style="color: #3D74B6;">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/products" style="color: #3D74B6;">Produk</a>
                    </li>
                </ul>

                @if(auth()->guard('customer')->check())
                <x-cart-icon>
                    <a href="{{ route('cart.index') }}">Cart</a>
                </x-cart-icon>
                @endif

                @if(auth()->guard('customer')->check())
                <div class="dropdown">
                    <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::guard('customer')->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('customer.logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a class="btn btn-outline-light me-2" href="{{ route('customer.login') }}">Login</a>
                <a class="btn btn-light" href="{{ route('customer.register') }}" style="color: #3D74B6;">Register</a>
                @endif
            </div>
        </div>
    </nav>
</div>