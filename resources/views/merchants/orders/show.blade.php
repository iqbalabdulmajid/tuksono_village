{{-- File: resources/views/merchants/orders/show.blade.php --}}
@extends('merchants.layouts.app')
@section('title', 'Detail Pesanan')
@section('content')
    <div class="page-header">
        {{-- ... breadcrumb ... --}}
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Detail Pesanan</h5></div>
                <div class="card-body">
                    <h6>Informasi Pelanggan</h6>
                    <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Telepon/WA:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Alamat:</strong> {{ $order->customer_address ?? '-' }}</p>
                    <hr>
                    <h6>Informasi Produk</h6>
                    <p><strong>Produk:</strong> {{ $order->product->name }}</p>
                    <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_amount) }}</p>
                    <p><strong>Platform:</strong> {{ $order->platform }}</p>
                    @if($order->payment_proof)
                        <h6>Bukti Pembayaran</h6>
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" class="img-fluid rounded" style="max-height: 200px;" alt="Bukti Bayar">
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h5>Ubah Status Pesanan</h5></div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('merchant.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Saat Ini: <strong>{{ $order->status }}</strong></label>
                            <select name="status" id="status" class="form-select">
                                <option value="Baru" @selected($order->status == 'Baru')>Baru</option>
                                <option value="Diproses" @selected($order->status == 'Diproses')>Diproses</option>
                                <option value="Selesai" @selected($order->status == 'Selesai')>Selesai</option>
                                <option value="Dibatalkan" @selected($order->status == 'Dibatalkan')>Dibatalkan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
