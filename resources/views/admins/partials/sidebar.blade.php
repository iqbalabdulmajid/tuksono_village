<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            {{-- Link logo mengarah ke dashboard admin --}}
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                <img src="{{ asset('assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
                <span class="badge bg-light-primary rounded-pill ms-2">Admin</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">

                {{-- KATEGORI UTAMA --}}
                <li class="pc-item pc-caption">
                    <label>Navigasi Utama</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="pc-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- KATEGORI MANAJEMEN KONTEN --}}
                <li class="pc-item pc-caption">
                    <label>Manajemen Konten</label>
                </li>
                <li class="pc-item">
                    {{-- Link ini sudah fungsional karena route-nya sudah kita buat --}}
                    <a href="{{ route('admin.products.index') }}"
                        class="pc-link {{ Route::is('admin.products.*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-box"></i></span>
                        <span class="pc-mtext">Produk</span>
                    </a>
                </li>
                <li class="pc-item">
                    {{-- Fitur belum dibuat, jadi href="#" --}}
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-message-2"></i></span>
                        <span class="pc-mtext">Ulasan</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#"
                        class="pc-link {{ Route::is('admin.posts.*') ? 'active' : '' }}">
                        <span class="pc-micon"><i class="ti ti-pencil"></i></span>
                        <span class="pc-mtext">Blog</span>
                    </a>
                </li>

                {{-- KATEGORI MANAJEMEN PENGGUNA --}}
                <li class="pc-item pc-caption">
                    <label>Manajemen Pengguna</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.users.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">User & Merchant</span>
                    </a>
                </li>

                {{-- KATEGORI LAINNYA --}}
                <li class="pc-item pc-caption">
                    <label>Lainnya</label>
                </li>
                <li class="pc-item">
                    {{-- Fitur belum dibuat, jadi href="#" --}}
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">Pengaturan Website</span>
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
