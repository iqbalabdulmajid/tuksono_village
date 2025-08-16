@extends('admins.layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 ms-1">Manajemen Produk</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Produk</li>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Produk</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
                <div class="card-body">
                    {{-- Form untuk Search, Filter, dan Sort --}}
                    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama produk..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <select name="merchant_id" class="form-select">
                                    <option value="">Semua Merchant</option>
                                    @foreach($merchants as $merchant)
                                        <option value="{{ $merchant->id }}" @selected(request('merchant_id') == $merchant->id)>{{ $merchant->nama_toko }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="category_id" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="sort_by" class="form-select">
                                    <option value="created_at" @selected(request('sort_by') == 'created_at')>Terbaru</option>
                                    <option value="name" @selected(request('sort_by') == 'name')>Nama</option>
                                    <option value="price" @selected(request('sort_by') == 'price')>Harga</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select name="sort_direction" class="form-select">
                                    <option value="asc" @selected(request('sort_direction') == 'asc')>A-Z</option>
                                    <option value="desc" @selected(request('sort_direction', 'desc') == 'desc')>Z-A</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Gambar</th>
                                    <th>Nama</th>
                                    <th>Pemilik/Merchant</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-width: 100px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->owner->name ?? 'N/A' }}</td>
                                        <td>
                                            @foreach($product->categories as $category)
                                                <span class="badge bg-light-primary">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-info" title="Lihat"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            {{-- Form hapus sekarang menggunakan class 'delete-form' --}}
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Produk tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('scripts')
<script>
    // Cek jika ada session 'success' untuk notifikasi
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    // Script untuk konfirmasi hapus dengan SweetAlert
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Mencegah form dikirim langsung
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Produk yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika user menekan "Ya, hapus!"
                    }
                });
            });
        });
    });
</script>
@endpush
