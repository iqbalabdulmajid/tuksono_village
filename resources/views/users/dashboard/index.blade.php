@extends('users.layouts.app')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('img/tuksono-1.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Selamat Datang di</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Website Resmi Desa Tuksono</h1>
                            <a href="#about" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Selengkapnya</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('img/tuksono-3.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Membangun Bersama</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Menuju Desa Mandiri dan Sejahtera</h1>
                            <a href="#services" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Lihat Potensi</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Fakta Desa Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Jumlah Penduduk</h5>
                            {{-- Menampilkan data dari pengaturan --}}
                            <h1 class="text-white mb-0" data-toggle="counter-up">{{ $settings['jumlah_penduduk'] ?? 0 }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-ruler-combined text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Luas Wilayah</h5>
                            <h1 class="mb-0" data-toggle="counter-up">{{ $settings['luas_wilayah'] ?? 0 }}</h1><span class="ms-2">Ha</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-store text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Jumlah UMKM</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">{{ $settings['jumlah_umkm'] ?? 0 }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fakta Desa End -->

    <!-- Tentang Desa Start -->
    <div id="about" class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Tentang Kami</h5>
                        <h1 class="mb-0">Sekilas Tentang Desa Tuksono</h1>
                    </div>
                    <p class="mb-4">Desa Tuksono merupakan desa yang asri dan subur, terletak di Kecamatan Sentolo, Kabupaten Kulon Progo. Dengan semangat gotong royong, kami terus berupaya membangun desa yang maju, mandiri, dan berbudaya berdasarkan potensi lokal yang kami miliki.</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Pemerintahan Akuntabel</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Masyarakat Berdaya</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Lingkungan Lestari</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Potensi Lokal Unggul</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Hubungi Kantor Desa</h5>
                            {{-- Menampilkan nomor telepon dari pengaturan --}}
                            <h4 class="text-primary mb-0">{{ $settings['phone_number'] ?? '(Nomor belum diatur)' }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('img/balaidesa.jpg') }}" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tentang Desa End -->

    {{-- ... (Sisa halaman Anda seperti Layanan dan Berita Desa) ... --}}

@endsection
