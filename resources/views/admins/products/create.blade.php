@extends('admins.layouts.app')

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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produk</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tambah Baru</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Tambah Produk</h5>
                </div>
                <div class="card-body">
                    {{-- Menambahkan id="product-form" --}}
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                        id="product-form">
                        @csrf

                        {{-- Form Fields Start --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Pemilik / Merchant</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Pilih Merchant</option>
                                @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" @selected(old('user_id') == $merchant->id)>{{ $merchant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="categories" class="form-label">Kategori</label>

                            {{-- Container yang bisa di-scroll --}}
                            <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">

                                {{-- Looping untuk setiap kategori sebagai checkbox --}}
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                            value="{{ $category->id }}" id="category-{{ $category->id }}"
                                            {{-- (Untuk form EDIT) Cek jika kategori ini sudah terpilih --}} @if (isset($product) && $product->categories->contains($category->id)) checked @endif>
                                        <label class="form-check-label" for="category-{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
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
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                id="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                        {{-- Form Fields End --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('scripts')
    <script>
        // Script untuk format harga
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

        // Menargetkan form dengan ID spesifik untuk menghapus format sebelum submit
        document.getElementById('product-form').addEventListener('submit', function() {
            priceInput.value = priceInput.value.replace(/\./g, '');
        });
    </script>
@endpush
