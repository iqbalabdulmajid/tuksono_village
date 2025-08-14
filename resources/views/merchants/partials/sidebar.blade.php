<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('merchant.dashboard') }}" class="b-brand text-primary">
                <img src="{{ asset('assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
                <span class="badge bg-light-success rounded-pill ms-2">Merchant</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">

                <li class="pc-item pc-caption">
                    <label>Navigasi Utama</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('merchant.dashboard') }}" class="pc-link {{ Route::is('merchant.dashboard') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Manajemen Toko</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('merchant.products.index') }}" class="pc-link {{ Route::is('merchant.products.*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-box"></i></span>
                        <span class="pc-mtext">Produk Saya</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                        <span class="pc-mtext">Pesanan</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Akun</label>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">Pengaturan Toko</span>
                    </a>
                </li>
                 <li class="pc-item">
                    <a href="{{ route('home') }}" class="pc-link" target="_blank">
                        <span class="pc-micon"><i class="ti ti-world"></i></span>
                        <span class="pc-mtext">Lihat Website</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
