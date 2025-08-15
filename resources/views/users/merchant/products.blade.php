@extends('users.layouts.app')

@section('title', 'Semua Produk dari ' . $merchant->nama_toko)

@section('styles')
<style>
    .product-card-link { text-decoration: none; color: inherit; }
    .product-card { background-color: #f8f9fa; border-radius: 0.25rem; text-align: center; height: 100%; display: flex; flex-direction: column; transition: all .3s ease-in-out; }
    .product-card:hover { box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15); transform: translateY(-5px); }
    .product-card-img { width: 100%; height: 225px; object-fit: cover; border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; }
    .product-card-body { padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; }
    .product-card-title { margin-bottom: 0.5rem; font-size: 1.25rem; }
    .product-card-price { color: #06A3DA; font-size: 1.5rem; font-weight: bold; margin-bottom: 0; }
    .pagination-container { margin-top: 2rem; }
    .page-link.active { background-color: #06A3DA; color: white; }
</style>
@endsection

@section('content')
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Produk dari Toko {{ $merchant->nama_toko }}</h1>
                <a href="{{ route('home') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ route('product') }}" class="h5 text-white">Semua Produk</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">{{ $merchant->nama_toko }}</a>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="mb-2">Produk dari Toko {{ $merchant->nama_toko }}</h1>
            <p class="text-muted">{{ $merchant->deskripsi_toko ?? 'Belum ada deskripsi toko.' }}</p>
            @if ($merchant->is_verified)
                <span class="badge bg-primary mb-4">
                    <i class="fas fa-badge-check me-1"></i> Toko Terverifikasi
                </span>
            @endif

            <div id="product-list" class="row g-4 mt-4">
                @forelse($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch product-item">
                        <a href="{{ route('product.show', $product->id) }}" class="product-card-link w-100">
                            <div class="card product-card h-100">
                                <img class="card-img-top product-card-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="card-body d-flex flex-column text-center">
                                    <h5 class="card-title product-card-title">{{ $product->name }}</h5>
                                    <h4 class="card-text product-card-price mt-auto">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info" role="alert">
                            <p class="mb-0">Toko ini belum memiliki produk.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Kontainer untuk tombol paginasi JS --}}
            <div id="pagination-container" class="pagination-container d-flex justify-content-center"></div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productList = document.getElementById('product-list');
        const paginationContainer = document.getElementById('pagination-container');
        const items = Array.from(productList.getElementsByClassName('product-item'));
        const itemsPerPage = 12; // Menampilkan 12 produk per halaman
        let currentPage = 1;

        function showPage(page) {
            currentPage = page;
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            items.forEach((item, index) => {
                if (index >= start && index < end) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
            updatePaginationButtons();
        }

        function setupPagination() {
            const pageCount = Math.ceil(items.length / itemsPerPage);
            paginationContainer.innerHTML = '';

            const ul = document.createElement('ul');
            ul.classList.add('pagination');

            // Tombol Previous
            const prevLi = document.createElement('li');
            prevLi.classList.add('page-item');
            const prevLink = document.createElement('a');
            prevLink.classList.add('page-link');
            prevLink.href = '#';
            prevLink.innerHTML = '&laquo;';
            prevLink.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    showPage(currentPage - 1);
                }
            });
            prevLi.appendChild(prevLink);
            ul.appendChild(prevLi);

            // Tombol Nomor Halaman
            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                const link = document.createElement('a');
                link.classList.add('page-link');
                link.href = '#';
                link.textContent = i;
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    showPage(i);
                });
                li.appendChild(link);
                ul.appendChild(li);
            }

            // Tombol Next
            const nextLi = document.createElement('li');
            nextLi.classList.add('page-item');
            const nextLink = document.createElement('a');
            nextLink.classList.add('page-link');
            nextLink.href = '#';
            nextLink.innerHTML = '&raquo;';
            nextLink.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage < pageCount) {
                    showPage(currentPage + 1);
                }
            });
            nextLi.appendChild(nextLink);
            ul.appendChild(nextLi);

            paginationContainer.appendChild(ul);
            updatePaginationButtons();
        }

        function updatePaginationButtons() {
            const pageItems = paginationContainer.querySelectorAll('.page-item');
            pageItems.forEach((item, index) => {
                item.classList.remove('active', 'disabled');
                const pageNumber = index; // index 0 adalah Prev, 1-N adalah page number
                if (pageNumber === currentPage) {
                    item.classList.add('active');
                }
            });

            const prevButton = paginationContainer.querySelector('.page-item:first-child');
            const nextButton = paginationContainer.querySelector('.page-item:last-child');
            if (currentPage === 1) {
                prevButton.classList.add('disabled');
            }
            if (currentPage === Math.ceil(items.length / itemsPerPage)) {
                nextButton.classList.add('disabled');
            }
        }

        if (items.length > itemsPerPage) {
            setupPagination();
            showPage(1);
        }
    });
</script>
@endsection
