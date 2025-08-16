@extends('users.layouts.app')
@section('content')
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Tentang Kami</h1>
                <a href="{{ route('home') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ route('about') }}" class="h5 text-white">Tentang Kami</a>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Tentang Desa</h5>
                        <h1 class="mb-0">Visi & Misi Desa Tuksono</h1>
                    </div>
                    <p class="mb-4">Terwujudnya Desa Tuksono yang mandiri, sejahtera, dan berbudaya melalui optimalisasi
                        potensi lokal dan partisipasi aktif masyarakat. Kami berkomitmen untuk menyelenggarakan pemerintahan
                        yang bersih, meningkatkan kualitas sumber daya manusia, dan melestarikan lingkungan hidup.</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Pemerintahan Akuntabel</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Masyarakat Berdaya</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Pelayanan Prima</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Lingkungan Lestari</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Hubungi Kantor Desa</h5>
                            <h4 class="text-primary mb-0">(0274) 123 456</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s"
                            src="https://placehold.co/600x800/28a745/ffffff?text=Kantor+Desa+Tuksono"
                            style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Perangkat Desa Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Struktur Organisasi</h5>
                <h1 class="mb-0">Perangkat Desa Tuksono</h1>
            </div>
            {{-- Cek apakah ada data perangkat desa sebelum menampilkan section --}}
            @if ($perangkatDesa->isNotEmpty())
                <div class="row g-5">
                    {{-- Looping untuk setiap item perangkat desa --}}
                    @foreach ($perangkatDesa as $perangkat)
                        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                            <div class="team-item bg-light rounded overflow-hidden">
                                <div class="team-img position-relative overflow-hidden">
                                    {{-- Tampilkan foto jika ada, jika tidak, tampilkan placeholder --}}
                                    @if ($perangkat->foto)
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $perangkat->foto) }}"
                                            alt="{{ $perangkat->nama }}">
                                    @else
                                        <img class="img-fluid w-100"
                                            src="https://placehold.co/600x600/ced4da/6c757d?text=Foto"
                                            alt="Foto belum tersedia">
                                    @endif
                                </div>
                                <div class="text-center py-4">
                                    <h4 class="text-primary">{{ $perangkat->nama }}</h4>
                                    <p class="text-uppercase m-0">{{ $perangkat->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- Perangkat Desa End -->
@endsection
