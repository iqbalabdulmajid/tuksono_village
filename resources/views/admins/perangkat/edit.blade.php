@extends('admins.layouts.app')

@section('title', 'Edit Perangkat Desa')

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 ms-1">Edit Perangkat Desa</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.perangkat.index') }}">Perangkat Desa</a></li>
                        <li class="breadcrumb-item" aria-current="page">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Edit Data: {{ $perangkat->nama }}</h5></div>
                <div class="card-body">
                    <form action="{{ route('admin.perangkat.update', $perangkat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $perangkat->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" value="{{ old('jabatan', $perangkat->jabatan) }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto (Ganti jika perlu)</label>
                            @if($perangkat->foto)
                                <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}" width="150" class="d-block mb-2 rounded">
                            @endif
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('admin.perangkat.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
