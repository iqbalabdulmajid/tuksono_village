{{-- File: resources/views/merchants/bank_accounts/create.blade.php --}}
@extends('merchants.layouts.app')
@section('title', 'Tambah Rekening Bank')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 ms-1">Tambah Rekening Bank</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('merchant.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('merchant.bank-accounts.index') }}">Rekening Bank</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Tambah</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Tambah Rekening Bank</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('merchant.bank-accounts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Nama Bank (Contoh: BCA, Mandiri, BRI)</label>
                            <input type="text" name="bank_name"
                                class="form-control @error('bank_name') is-invalid @enderror" id="bank_name"
                                value="{{ old('bank_name', $bankAccount->bank_name ?? '') }}" required>
                            @error('bank_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bank_logo" class="form-label">Logo Bank</label>
                            <input type="file" name="bank_logo"
                                class="form-control @error('bank_logo') is-invalid @enderror" id="bank_logo">
                            @error('bank_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="account_holder_name" class="form-label">Nama Pemilik Rekening</label>
                            <input type="text" name="account_holder_name"
                                class="form-control @error('account_holder_name') is-invalid @enderror"
                                id="account_holder_name"
                                value="{{ old('account_holder_name', $bankAccount->account_holder_name ?? '') }}" required>
                            @error('account_holder_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="account_number" class="form-label">Nomor Rekening</label>
                            <input type="text" name="account_number"
                                class="form-control @error('account_number') is-invalid @enderror" id="account_number"
                                value="{{ old('account_number', $bankAccount->account_number ?? '') }}" required>
                            @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('merchant.bank-accounts.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
