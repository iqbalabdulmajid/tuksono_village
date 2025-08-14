<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="index.html" class="navbar-brand p-0">
            <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>Startup</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ Route::is('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link {{ Route::is('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('product') }}"
                    class="nav-item nav-link {{ Route::is('product') ? 'active' : '' }} {{ Route::is('product.show') ? 'active' : '' }}">Product</a>
                <a href="{{ route('blog') }}"
                    class="nav-item nav-link {{ Route::is('blog') ? 'active' : '' }} {{ Route::is('blog.show') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('contact') }}"
                    class="nav-item nav-link {{ Route::is('contact') ? 'active' : '' }}">Contact</a>
            </div>
            {{-- Tombol Search (tetap sama) --}}
            <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </button>

            @guest
                {{-- TAMPIL JIKA PENGGUNA BELUM LOGIN --}}
                <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 ms-3">Login</a>
            @endguest

            @auth
                {{-- TAMPIL JIKA PENGGUNA SUDAH LOGIN --}}
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-black ms-3" data-bs-toggle="dropdown">
                        <i class="fa fa-user me-2"></i>{{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu m-0">
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Admin Dashboard</a>
                        @endif
                        {{-- Tambahkan link untuk peran lain jika perlu --}}
                        {{-- @if (Auth::user()->isPemilikUsaha())
                <a href="{{ route('owner.dashboard') }}" class="dropdown-item">Owner Dashboard</a>
            @endif --}}
                        <a href="#" class="dropdown-item">Profil Saya</a>
                        <hr class="dropdown-divider">

                        {{-- Tombol Logout harus menggunakan form --}}
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </nav>


</div>
<!-- Navbar & Carousel End -->
<!-- Full Screen Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
            <div class="modal-header border-0">
                <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <div class="input-group" style="max-width: 600px;">
                    <input type="text" class="form-control bg-transparent border-primary p-3"
                        placeholder="Type search keyword">
                    <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
