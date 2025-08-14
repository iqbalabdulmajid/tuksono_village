@extends('users.layouts.app')

@section('styles')
{{-- CSS untuk kartu produk (jika belum ada di layout utama) --}}
<style>
    .product-card-link{text-decoration:none;color:inherit}.product-card{background-color:#f8f9fa;border-radius:.25rem;text-align:center;height:100%;display:flex;flex-direction:column;transition:all .3s ease-in-out}.product-card:hover{box-shadow:0 .5rem 1rem rgba(0,0,0,.15);transform:translateY(-5px)}.product-card-img{width:100%;height:225px;object-fit:cover;border-top-left-radius:.25rem;border-top-right-radius:.25rem}.product-card-body{padding:1.5rem;flex-grow:1;display:flex;flex-direction:column;justify-content:center}.product-card-title{margin-bottom:.5rem;font-size:1.25rem}.product-card-price{color:#06A3DA;font-size:1.5rem;font-weight:700;margin-bottom:0}

    /* 🎨 CSS Tambahan untuk Bagian Ulasan */
    .review-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .review-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .review-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #06A3DA;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }
    .star-rating .fa-star {
        color: #ffc107; /* Warna kuning untuk bintang */
    }
</style>
@endsection


@section('content')
    {{-- Header & Breadcrumb (Sama seperti sebelumnya) --}}
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Detail Produk</h1>
                <a href="#" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">Produk</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">Pupuk Kompos Super</a>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            {{-- Bagian detail produk yang sudah ada --}}
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="mb-4">
                        <img class="img-fluid w-100 rounded" src="https://placehold.co/800x600/28a745/white?text=Pupuk+Kompos" alt="Gambar Produk">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="bg-light rounded p-4">
                        <h1 class="mb-3">Pupuk Kompos Super</h1>
                        <h2 class="text-primary mb-4">Rp 50.000</h2>
                        <div class="d-flex mb-4">
                            <div class="star-rating me-3">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>(12 Ulasan)</span>
                        </div>
                        <p class="mb-4">Pupuk organik berkualitas tinggi untuk meningkatkan kesuburan tanah dan hasil panen Anda secara alami.</p>
                        <div class="d-grid gap-2 mt-4">
                             <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20produk%20Pupuk%20Kompos%20Super." target="_blank" class="btn btn-primary py-3 px-5"><i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp</a>
                             <a href="#" class="btn btn-secondary py-3 px-5"><i class="fa fa-shopping-cart me-2"></i>Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            {{-- 👇 [BAGIAN BARU] Ulasan dan Rating --}}
            <div class="row g-5 mt-4">
                <div class="col-12">
                    <h2 class="mb-4">Ulasan & Rating Pelanggan</h2>

                    {{-- Daftar Ulasan yang Sudah Ada --}}
                    <div class="review-list mb-5">
                        {{-- Ulasan 1 --}}
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
                        {{-- Ulasan 2 --}}
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

                    {{-- Form untuk Memberi Ulasan (UI Statis) --}}
                    <div class="add-review bg-light p-4 rounded">
                        <h4 class="mb-4">Tulis Ulasan Anda</h4>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Anda</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="rating" class="form-label">Rating</label>
                                    <select id="rating" class="form-select">
                                        <option selected>Pilih Rating...</option>
                                        <option value="5">★★★★★ (Luar Biasa)</option>
                                        <option value="4">★★★★☆ (Bagus)</option>
                                        <option value="3">★★★☆☆ (Cukup)</option>
                                        <option value="2">★★☆☆☆ (Kurang)</option>
                                        <option value="1">★☆☆☆☆ (Buruk)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="comment" class="form-label">Komentar Anda</label>
                                    <textarea class="form-control" id="comment" rows="4"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h2 class="mb-0">Produk Serupa yang Mungkin Anda Suka</h2>
            </div>
            <div class="row g-4">
                {{-- Produk Serupa 1 --}}
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="product-card-link">
                        <div class="product-card">
                            <img class="product-card-img" src="https://placehold.co/600x400/17a2b8/white?text=POC" alt="Pupuk Organik Cair">
                            <div class="product-card-body">
                                <h5 class="product-card-title">Pupuk Organik Cair (POC)</h5>
                                <h4 class="product-card-price">Rp 65.000</h4>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- Produk Serupa 2 --}}
                <div class="col-lg-4 col-md-6">
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
                {{-- Produk Serupa 3 --}}
                <div class="col-lg-4 col-md-6">
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
            </div>
        </div>
    </div>
@endsection
