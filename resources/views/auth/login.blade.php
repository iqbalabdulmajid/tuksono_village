@extends('layouts.app')

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="#"><img src="{{ asset('/admin_assets/images/logo-dark.svg') }}" alt="img"></a>
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        {{-- 1. Tambahkan tag <form> dengan method POST dan action ke route 'login' --}}
                        <form method="POST" action="{{ route('login') }}">
                            {{-- 2. Tambahkan token CSRF untuk keamanan, ini wajib ada di setiap form Laravel --}}
                            @csrf

                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Login</b></h3>
                                {{-- 6. Update link ke halaman register --}}
                                <a href="{{ route('register') }}" class="link-primary">Don't have an account?</a>
                            </div>

                            {{-- Input Email --}}
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email Address</label>
                                {{-- 3. Tambahkan atribut name, id, dan value old() serta class is-invalid untuk error --}}
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Email Address">

                                {{-- 4. Tampilkan pesan error validasi untuk email --}}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password</label>
                                {{-- 3. Tambahkan atribut name dan id --}}
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password" placeholder="Password">

                                {{-- 4. Tampilkan pesan error validasi untuk password --}}
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check">
                                    {{-- 3. Tambahkan atribut name untuk 'remember me' --}}
                                    <input class="form-check-input input-primary" type="checkbox" name="remember"
                                        id="customCheckc1" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
                                </div>
                                {{-- 6. Update link ke halaman lupa password --}}
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-secondary">
                                        <h5>Forgot Password?</h5>
                                    </a>
                                @endif
                            </div>

                            {{-- Tombol Login --}}
                            <div class="d-grid mt-4">
                                {{-- 5. Ubah button menjadi type="submit" agar bisa mengirimkan form --}}
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form> {{-- Penutup tag form --}}

                        {{-- Bagian Social Login (akan kita bahas nanti) --}}
                        <div class="saprator mt-3">
                            <span>Login with</span>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="d-grid">
                                    <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                        <img src="{{ asset('/admin_assets/images/authentication/google.svg') }}"
                                            alt="img"> <span class="d-none d-sm-inline-block"> Google</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-grid">
                                    <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                        <img src="{{ asset('/admin_assets/images/authentication/twitter.svg') }}"
                                            alt="img"> <span class="d-none d-sm-inline-block"> Twitter</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-grid">
                                    <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                        <img src="{{ asset('/admin_assets/images/authentication/facebook.svg') }}"
                                            alt="img"> <span class="d-none d-sm-inline-block"> Facebook</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="auth-footer row">
                    <!-- <div class=""> -->
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
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
