@extends('admins.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Summary Cards -->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Produk</h6>
                        <h4 class="mb-3">{{ number_format($totalProducts) }}</h4>
                        <p class="mb-0 text-muted text-sm">Jumlah semua produk terdaftar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Kategori</h6>
                        <h4 class="mb-3">{{ number_format($totalCategories) }}</h4>
                        <p class="mb-0 text-muted text-sm">Jumlah kategori produk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Merchant</h6>
                        <h4 class="mb-3">{{ number_format($totalMerchants) }}</h4>
                        <p class="mb-0 text-muted text-sm">Jumlah pemilik usaha terdaftar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total User</h6>
                        <h4 class="mb-3">{{ number_format($totalUsers) }}</h4>
                        <p class="mb-0 text-muted text-sm">Jumlah pengguna biasa terdaftar</p>
                    </div>
                </div>
            </div>

            <!-- Recent Products Table -->
            {{-- PERBAIKAN: Menambahkan class mt-4 untuk memberi jarak dari atas --}}
            <div class="col-md-12 mt-4">
                <h5 class="mb-3">Produk Terbaru</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Merchant</th>
                                        <th>Harga</th>
                                        <th class="text-end">Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentProducts as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        class="img-fluid rounded me-3"
                                                        style="width: 40px; height: 40px; object-fit: cover;"
                                                        alt="{{ $product->name }}">
                                                    <a
                                                        href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $product->owner->name ?? 'N/A' }}</td>
                                            <td>Rp {{ number_format($product->price) }}</td>
                                            <td class="text-end">{{ $product->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada produk.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- [ Main Content ] end -->
@endsection
