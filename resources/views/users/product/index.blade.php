{{-- File: resources/views/users/products.blade.php --}}

@extends('users.layouts.app')

@section('styles')
<style>
    .product-card-link { text-decoration: none; color: inherit; }
    .product-card { background-color: #f8f9fa; border-radius: 0.25rem; text-align: center; height: 100%; display: flex; flex-direction: column; transition: all .3s ease-in-out; }
    .product-card:hover { box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15); transform: translateY(-5px); }
    .product-card-img { width: 100%; height: 225px; object-fit: cover; border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; }
    .product-card-body { padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; }
    .product-card-title { margin-bottom: 0.5rem; font-size: 1.25rem; }
    .product-card-price { color: #06A3DA; font-size: 1.5rem; font-weight: bold; margin-bottom: 0; }
    .product-filters .btn { margin: 5px; }
</style>
@endsection

@section('content')
    {{-- Bagian Header & Breadcrumb --}}
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Produk Kami</h1>
                <a href="{{ route('home') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ route('product') }}" class="h5 text-white">Produk</a>
            </div>
        </div>
    </div>

    <!-- Products Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            {{-- Filter Menu Dinamis --}}
            <div class="row">
                <div class="col-12 text-center product-filters mb-5">
                    {{-- Tombol untuk menampilkan semua produk --}}
                    <a href="{{ route('product') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}">Semua Produk</a>

                    {{-- Tombol untuk setiap kategori dari database --}}
                    @foreach($categories as $category)
                        <a href="{{ route('product', ['category' => $category->slug]) }}" class="btn {{ request('category') == $category->slug ? 'btn-primary' : 'btn-outline-primary' }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Kontainer untuk daftar produk dinamis --}}
            <div class="row g-4" id="product-list">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.show', $product->id) }}" class="product-card-link">
                            <div class="product-card">
                                <img class="product-card-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="product-card-body">
                                    <h5 class="product-card-title">{{ $product->name }}</h5>
                                    <h4 class="product-card-price">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h4 class="text-muted">Produk tidak ditemukan.</h4>
                    </div>
                @endforelse
            </div>

            {{-- Navigasi Pagination dari Laravel --}}
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
    <!-- Products End -->
@endsection
