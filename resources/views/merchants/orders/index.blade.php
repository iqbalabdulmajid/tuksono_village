{{-- File: resources/views/merchants/orders/index.blade.php --}}
@extends('merchants.layouts.app')
@section('title', 'Manajemen Pesanan')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title"><h5 class="m-b-10 ms-1">Manajemen Pesanan</h5></div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('merchant.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pesanan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Daftar Pesanan Masuk</h5></div>
                <div class="card-body">
                    <form method="GET" action="{{ route('merchant.orders.index') }}" class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="Baru" @selected(request('status') == 'Baru')>Baru</option>
                                    <option value="Diproses" @selected(request('status') == 'Diproses')>Diproses</option>
                                    <option value="Selesai" @selected(request('status') == 'Selesai')>Selesai</option>
                                    <option value="Dibatalkan" @selected(request('status') == 'Dibatalkan')>Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Pelanggan</th>
                                    <th>Platform</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td><span class="badge bg-light-info">{{ $order->platform }}</span></td>
                                    <td>Rp {{ number_format($order->total_amount) }}</td>
                                    <td>
                                        <span class="badge
                                            @if($order->status == 'Baru') bg-light-primary @endif
                                            @if($order->status == 'Diproses') bg-light-warning @endif
                                            @if($order->status == 'Selesai') bg-light-success @endif
                                            @if($order->status == 'Dibatalkan') bg-light-danger @endif
                                        ">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('merchant.orders.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada pesanan yang masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">{{ $orders->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
