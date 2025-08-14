@extends('merchants.layouts.app')

@section('title', 'Detail Produk')

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
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                            @else
                                <div class="border rounded bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
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
                            <a href="{{ route('merchant.products.edit', $product->id) }}" class="btn btn-warning">Edit Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
