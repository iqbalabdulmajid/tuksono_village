@extends('merchants.layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 ms-1">Tambah Produk Baru</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('merchant.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('merchant.products.index') }}">Produk</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tambah Baru</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Form Tambah Produk</h5></div>
                <div class="card-body">
                    <form action="{{ route('merchant.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="categories" class="form-label">Kategori</label>
                            <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                                @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                                    <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="price" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Produk</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <h5 class="mb-3">Link Pembelian (Opsional)</h5>

                        <div class="mb-3">
                            <label for="link_shopee" class="form-label">Link Shopee</label>
                            <input type="url" name="link_shopee" class="form-control" value="{{ old('link_shopee') }}" placeholder="https://shopee.co.id/...">
                        </div>
                        <div class="mb-3">
                            <label for="link_tokopedia" class="form-label">Link Tokopedia</label>
                            <input type="url" name="link_tokopedia" class="form-control" value="{{ old('link_tokopedia') }}" placeholder="https://www.tokopedia.com/...">
                        </div>
                        <div class="mb-3">
                            <label for="link_fb_marketplace" class="form-label">Link Facebook Marketplace</label>
                            <input type="url" name="link_fb_marketplace" class="form-control" value="{{ old('link_fb_marketplace') }}" placeholder="https://www.facebook.com/marketplace/...">
                        </div>
                        <div class="mb-3">
                            <label for="link_tanihub" class="form-label">Link TaniHub</label>
                            <input type="url" name="link_tanihub" class="form-control" value="{{ old('link_tanihub') }}" placeholder="https://tanihub.com/...">
                        </div>
                        <a href="{{ route('merchant.products.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Script untuk format harga --}}
    <script>
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('keyup', function(e) {
            let value = this.value.replace(/[^,\d]/g, '').toString();
            let number_string = value.replace(/,/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            this.value = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        });
        document.getElementById('product-form').addEventListener('submit', function() {
            priceInput.value = priceInput.value.replace(/\./g, '');
        });
    </script>
@endpush
