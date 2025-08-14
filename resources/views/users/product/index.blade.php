{{-- File: resources/views/users/products.blade.php --}}

@extends('users.layouts.app')

{{-- Menambahkan CSS khusus untuk halaman ini --}}
@section('styles')
<style>
    /* ... (CSS dari jawaban sebelumnya tetap sama) ... */
    .product-card-link { text-decoration: none; color: inherit; }
    .product-card { background-color: #f8f9fa; border-radius: 0.25rem; text-align: center; height: 100%; display: flex; flex-direction: column; transition: all .3s ease-in-out; }
    .product-card:hover { box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15); transform: translateY(-5px); }
    .product-card-img { width: 100%; height: 225px; object-fit: cover; border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; }
    .product-card-body { padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; }
    .product-card-title { margin-bottom: 0.5rem; font-size: 1.25rem; }
    .product-card-price { color: #06A3DA; font-size: 1.5rem; font-weight: bold; margin-bottom: 0; }

    /* 🎨 CSS Baru untuk Filter dan Pagination */
    .product-filters {
        margin-bottom: 2rem;
    }
    .product-filters .btn {
        margin: 0 5px;
    }
    .product-filters .btn.active {
        background-color: #06A3DA !important;
        color: #fff !important;
        border-color: #06A3DA !important;
    }
    .pagination-container {
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
    {{-- Bagian Header & Breadcrumb (Sama seperti sebelumnya) --}}
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Produk Kami</h1>
                <a href="#" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">Produk</a>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            {{--  फिल्टर मेनू --}}
            <div class="row">
                <div class="col-12 text-center product-filters">
                    <button class="btn btn-outline-primary active" data-filter="*">Semua Produk</button>
                    <button class="btn btn-outline-primary" data-filter="organik">Produk Organik</button>
                    <button class="btn btn-outline-primary" data-filter="anorganik">Produk Anorganik</button>
                </div>
            </div>

            {{-- Kontainer untuk semua produk --}}
            <div class="row g-4" id="product-list">

                {{-- 👇 Setiap produk sekarang memiliki atribut 'data-category' --}}

                {{-- Produk 1 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="organik">
                    <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/28a745/white?text=Pupuk+Kompos" alt="Pupuk Kompos">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Pupuk Kompos Super</h5>
                                <h4 class="product-card-price">Rp 50.000</h4>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Produk 2 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="anorganik">
                    <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/007bff/white?text=Pupuk+NPK" alt="Pupuk NPK">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Pupuk NPK Mutiara</h5>
                                <h4 class="product-card-price">Rp 120.000</h4>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Produk 3 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="organik">
                    <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/6f4e37/white?text=Pestisida+Nabati" alt="Pestisida Nabati">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Pestisida Nabati</h5>
                                <h4 class="product-card-price">Rp 75.000</h4>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Produk 4 --}}
                 <div class="col-lg-4 col-md-6 product-item" data-category="anorganik">
                    <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/dc3545/white?text=Herbisida" alt="Herbisida">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Herbisida Sistemik</h5>
                                <h4 class="product-card-price">Rp 95.000</h4>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Tambahkan lebih banyak produk di sini (total 10-12 produk atau lebih untuk melihat efek pagination) --}}
                {{-- Produk 5 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="organik">
                     <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/17a2b8/white?text=Benih+Organik" alt="Benih Organik">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Benih Sayur Organik</h5>
                                <h4 class="product-card-price">Rp 25.000</h4>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Produk 6 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="anorganik">
                     <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/ffc107/black?text=Pupuk+Urea" alt="Pupuk Urea">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Pupuk Urea Non-Subsidi</h5>
                                <h4 class="product-card-price">Rp 88.000</h4>
                            </div>
                        </div>
                    </a>
                </div>
                 {{-- Produk 7 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="organik">
                     <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/20c997/white?text=POC" alt="Pupuk Organik Cair">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Pupuk Organik Cair (POC)</h5>
                                <h4 class="product-card-price">Rp 65.000</h4>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- Produk 8 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="anorganik">
                     <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/6610f2/white?text=Fungisida" alt="Fungisida">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Fungisida Kontak</h5>
                                <h4 class="product-card-price">Rp 110.000</h4>
                            </div>
                        </div>
                    </a>
                </div>
                 {{-- Produk 9 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="organik">
                     <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/fd7e14/white?text=Sekam+Bakar" alt="Sekam Bakar">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Media Tanam Sekam Bakar</h5>
                                <h4 class="product-card-price">Rp 30.000</h4>
                            </div>
                        </div>
                    </a>
                </div>
                 {{-- Produk 10 --}}
                <div class="col-lg-4 col-md-6 product-item" data-category="anorganik">
                     <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/343a40/white?text=KCL" alt="Pupuk KCL">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Pupuk KCL Mahkota</h5>
                                <h4 class="product-card-price">Rp 150.000</h4>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            {{-- Navigasi Pagination akan dibuat oleh JavaScript di sini --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-center pagination-container">
                    <nav>
                        <ul class="pagination" id="pagination">
                           {{-- Tombol halaman akan muncul di sini --}}
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    @endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {

    const productItems = document.querySelectorAll('.product-item');
    const filterButtons = document.querySelectorAll('.product-filters .btn');
    const paginationContainer = document.getElementById('pagination');

    const productsPerPage = 9;
    let currentPage = 1;
    let currentFilter = '*';

    function applyFilterAndPagination() {
        // 1. Tentukan produk mana yang terlihat berdasarkan filter
        let filteredProducts = [];
        productItems.forEach(item => {
            if (currentFilter === '*' || item.dataset.category === currentFilter) {
                filteredProducts.push(item);
            }
        });

        // 2. Sembunyikan semua produk terlebih dahulu
        productItems.forEach(item => item.style.display = 'none');

        // 3. Hitung item untuk halaman saat ini
        const startIndex = (currentPage - 1) * productsPerPage;
        const endIndex = startIndex + productsPerPage;
        const productsToShow = filteredProducts.slice(startIndex, endIndex);

        // 4. Tampilkan hanya produk untuk halaman ini
        productsToShow.forEach(item => item.style.display = 'block');

        // 5. Buat ulang tombol pagination
        setupPagination(filteredProducts.length);
    }

    function setupPagination(totalItems) {
        paginationContainer.innerHTML = ''; // Kosongkan pagination
        const pageCount = Math.ceil(totalItems / productsPerPage);

        for (let i = 1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.innerText = i;
            a.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                applyFilterAndPagination();
            });
            li.appendChild(a);
            paginationContainer.appendChild(li);
        }
    }

    // Event listener untuk tombol filter
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Hapus kelas 'active' dari semua tombol
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Tambahkan 'active' ke tombol yang diklik
            button.classList.add('active');

            currentFilter = button.dataset.filter;
            currentPage = 1; // Reset ke halaman pertama setiap kali filter diubah
            applyFilterAndPagination();
        });
    });

    // Terapkan filter dan pagination saat halaman pertama kali dimuat
    applyFilterAndPagination();

});
</script>
@endpush
