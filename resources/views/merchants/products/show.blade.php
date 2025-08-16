@extends('merchants.layouts.app')

@section('title', 'Detail Produk')
@section('styles')
    <style>
        /* CSS untuk bintang rating */
        .star-rating .fa-star,
        .star-rating .far.fa-star {
            color: #ffc107;
        }

        .review-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .review-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
    </style>
@endsection
@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 ms-1">Detail Produk</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('merchant.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('merchant.products.index') }}">Produk</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Informasi Produk: {{ $product->name }}</h5>
                    <a href="{{ route('merchant.products.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="img-fluid rounded">
                            @else
                                <div class="border rounded bg-light d-flex align-items-center justify-content-center"
                                    style="height: 250px;">
                                    <span class="text-muted">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $product->name }}</h3>
                            <h4 class="text-primary mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                            <div class="mb-3">
                                <strong>Kategori:</strong>
                                @forelse($product->categories as $category)
                                    <span class="badge bg-light-primary">{{ $category->name }}</span>
                                @empty
                                    <span class="text-muted">Tidak ada kategori</span>
                                @endforelse
                            </div>
                            <hr>
                            <h5>Deskripsi</h5>
                            <div style="white-space: pre-wrap;">{{ $product->description }}</div>
                            <hr>

                            {{-- Tombol Link Marketplace --}}
                            <h5>Link Marketplace</h5>
                            <div class="mt-2">
                                @if ($product->link_shopee)
                                    <a href="{{ $product->link_shopee }}" target="_blank" class="btn btn-sm"
                                        style="background-color: #EE4D2D; color: white;">Shopee</a>
                                @endif
                                @if ($product->link_tokopedia)
                                    <a href="{{ $product->link_tokopedia }}" target="_blank" class="btn btn-sm"
                                        style="background-color: #03AC0E; color: white;">Tokopedia</a>
                                @endif
                                @if ($product->link_fb_marketplace)
                                    <a href="{{ $product->link_fb_marketplace }}" target="_blank"
                                        class="btn btn-sm btn-primary">Facebook</a>
                                @endif
                                @if ($product->link_tanihub)
                                    <a href="{{ $product->link_tanihub }}" target="_blank"
                                        class="btn btn-sm btn-info text-white">TaniHub</a>
                                @endif
                                @if (!$product->link_shopee && !$product->link_tokopedia && !$product->link_fb_marketplace && !$product->link_tanihub)
                                    <p class="text-muted">Belum ada link marketplace yang ditambahkan.</p>
                                @endif
                            </div>

                            <hr>
                            <a href="{{ route('merchant.products.edit', $product->id) }}" class="btn btn-warning">Edit
                                Produk</a>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Ulasan Produk</h5>
                                </div>
                                <div class="card-body">
                                    @forelse($product->reviews as $review)
                                        <div class="review-item">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $review->user->name }}</strong>
                                                <small
                                                    class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                            </div>
                                            <div class="star-rating my-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="{{ $i <= $review->rating ? 'fas fa-star' : 'far fa-star' }}"></i>
                                                @endfor
                                            </div>
                                            <p class="mb-0">{{ $review->comment }}</p>
                                        </div>
                                    @empty
                                        <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
