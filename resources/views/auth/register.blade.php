@extends('layouts.app')

@section('content')
<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="auth-header">
                <a href="#"><img src="{{ asset('admin_assets/images/logo-dark.svg') }}" alt="img"></a>
            </div>
            <div class="card my-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <h3 class="mb-0"><b>Sign up</b></h3>
                        <a href="{{ route('login') }}" class="link-primary">Already have an account?</a>
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        <button id="showUserFormBtn" class="btn btn-primary me-2">Daftar sebagai User</button>
                        <button id="showMerchantFormBtn" class="btn btn-secondary">Daftar sebagai Merchant</button>
                    </div>

                    <form id="userForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}*</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}*</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}*</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}*</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary">{{ __('Create User Account') }}</button>
                        </div>
                    </form>

                    <form id="merchantForm" method="POST" action="{{ route('register.merchant') }}" style="display:none;">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">{{ __('Nama Anda') }}*</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_toko" class="form-label">{{ __('Nama Toko') }}*</label>
                            <input id="nama_toko" type="text" class="form-control @error('nama_toko') is-invalid @enderror" name="nama_toko" value="{{ old('nama_toko') }}" required>
                            @error('nama_toko')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}*</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}*</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}*</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary">{{ __('Create Merchant Account') }}</button>
                        </div>
                    </form>

                    <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a></p>
                </div>
            </div>
            <div class="auth-footer row">
                <div class="col my-1">
                    <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="#">Home</a></li>
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('showUserFormBtn').addEventListener('click', function() {
        document.getElementById('userForm').style.display = 'block';
        document.getElementById('merchantForm').style.display = 'none';
        this.classList.remove('btn-secondary');
        this.classList.add('btn-primary');
        document.getElementById('showMerchantFormBtn').classList.remove('btn-primary');
        document.getElementById('showMerchantFormBtn').classList.add('btn-secondary');
    });

    document.getElementById('showMerchantFormBtn').addEventListener('click', function() {
        document.getElementById('userForm').style.display = 'none';
        document.getElementById('merchantForm').style.display = 'block';
        this.classList.remove('btn-secondary');
        this.classList.add('btn-primary');
        document.getElementById('showUserFormBtn').classList.remove('btn-primary');
        document.getElementById('showUserFormBtn').classList.add('btn-secondary');
    });
</script>
@endsection
