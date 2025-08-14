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

    /* CSS for star ratings and reviews */
    .star-rating .fa-star { color: #ffc107; }
    .review-item { border-bottom: 1px solid #eee; padding-bottom: 1.5rem; margin-bottom: 1.5rem; }
    .review-item:last-child { border-bottom: none; margin-bottom: 0; }
    .review-avatar { width: 50px; height: 50px; border-radius: 50%; background-color: #06A3DA; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; }
</style>
@endsection

@section('content')
    {{-- Header & Breadcrumb --}}
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Detail Produk</h1>
                <a href="{{ route('home') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ route('product') }}" class="h5 text-white">Produk</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">{{ $product->name }}</a>
            </div>
        </div>
    </div>

    <!-- Detail Produk Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <!-- Gambar Produk -->
                    <div class="mb-4">
                        <img class="img-fluid w-100 rounded" src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk {{ $product->name }}">
                    </div>
                </div>

                <div class="col-lg-5">
                    <!-- Info Produk -->
                    <div class="bg-light rounded p-4">
                        <h1 class="mb-3">{{ $product->name }}</h1>
                        <h2 class="text-primary mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>

                        {{-- Rating Summary --}}
                        <div class="d-flex mb-3">
                            <div class="star-rating me-2">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>(Placeholder: 12 Ulasan)</span>
                        </div>

                        <div class="mb-4">
                            <strong>Kategori:</strong>
                            @forelse($product->categories as $category)
                                <span class="badge bg-primary">{{ $category->name }}</span>
                            @empty
                                <span class="text-muted">Tidak ada kategori</span>
                            @endforelse
                        </div>

                        <div class="d-grid gap-2 mt-4">
                             <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}" target="_blank" class="btn btn-success py-3 px-5">
                                <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
                            </a>
                             <a href="#" class="btn btn-primary py-3 px-5">
                                <i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <!-- Reviews Section Start -->
            <div class="row g-5 mt-4">
                <div class="col-12">
                    <h2 class="mb-4">Ulasan & Rating</h2>

                    {{-- Form untuk Memberi Ulasan (Hanya untuk user yang login) --}}
                    @auth
                    <div class="add-review bg-light p-4 rounded mb-5">
                        <h4 class="mb-4">Tulis Ulasan Anda</h4>
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="rating" class="form-label">Rating Anda</label>
                                    <select id="rating" name="rating" class="form-select" required>
                                        <option value="">Pilih Bintang...</option>
                                        <option value="5">★★★★★ (Luar Biasa)</option>
                                        <option value="4">★★★★☆ (Bagus)</option>
                                        <option value="3">★★★☆☆ (Cukup)</option>
                                        <option value="2">★★☆☆☆ (Kurang)</option>
                                        <option value="1">★☆☆☆☆ (Buruk)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="comment" class="form-label">Komentar Anda</label>
                                    <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Bagikan pengalaman Anda tentang produk ini..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="alert alert-info" role="alert">
                        <a href="{{ route('login') }}">Login</a> untuk memberikan ulasan.
                    </div>
                    @endauth

                    {{-- Daftar Ulasan yang Sudah Ada --}}
                    <div class="review-list">
                        {{-- Contoh Ulasan 1 (Nanti akan diganti dengan data dinamis) --}}
                        <div class="review-item d-flex">
                            <div class="review-avatar me-3">B</div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">Budi Santoso</h5>
                                    <small>10 Agustus 2025</small>
                                </div>
                                <div class="star-rating mb-2">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                                <p>Produknya bagus sekali! Tanaman saya jadi lebih subur setelah pakai pupuk ini. Pengiriman juga cepat. Sangat direkomendasikan!</p>
                            </div>
                        </div>
                        {{-- Contoh Ulasan 2 --}}
                        <div class="review-item d-flex">
                             <div class="review-avatar me-3" style="background-color: #dc3545;">S</div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">Siti Aminah</h5>
                                    <small>08 Agustus 2025</small>
                                </div>
                                <div class="star-rating mb-2">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <p>Kualitasnya oke, tapi kemasannya sedikit sobek saat diterima. Mungkin bisa diperbaiki lagi untuk packingnya. Selebihnya memuaskan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reviews Section End -->
        </div>
    </div>
    <!-- Detail Produk End -->

    <!-- Produk Serupa Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h2 class="mb-0">Produk Serupa</h2>
            </div>
            <div class="row g-4">
                @forelse($similarProducts as $similar)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('product.show', $similar->id) }}" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="{{ asset('storage/' . $similar->image) }}" alt="{{ $similar->name }}">
                            <div class="product-card-body">
                                <h5 class="product-card-title">{{ $similar->name }}</h5>
                                <h4 class="product-card-price">Rp {{ number_format($similar->price, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Tidak ada produk serupa.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Produk Serupa End -->
@endsection
