@extends('admins.layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 ms-1">Pengaturan Website</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengaturan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pengaturan Umum Website</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Nomor Telepon Kantor Desa</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $settings['phone_number'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Kantor Desa</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $settings['email'] ?? '' }}">
                        </div>
                        <hr>
                        <h5 class="mb-3">Fakta Desa (Homepage)</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                <input type="number" name="jumlah_penduduk" id="jumlah_penduduk" class="form-control" value="{{ $settings['jumlah_penduduk'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="luas_wilayah" class="form-label">Luas Wilayah (Ha)</label>
                                <input type="number" name="luas_wilayah" id="luas_wilayah" class="form-control" value="{{ $settings['luas_wilayah'] ?? '' }}">
                            </div>
                             <div class="col-md-4 mb-3">
                                <label for="jumlah_umkm" class="form-label">Jumlah UMKM</label>
                                <input type="number" name="jumlah_umkm" id="jumlah_umkm" class="form-control" value="{{ $settings['jumlah_umkm'] ?? '' }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
