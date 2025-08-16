<!-- Footer Start -->
<div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Hubungi Kami</h3>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            <p class="mb-0">Tuksono, Sentolo, Kulon Progo</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-primary me-2"></i>
                            {{-- Menampilkan email dari pengaturan --}}
                            <p class="mb-0">{{ $settings['email'] ?? 'info@desa.id' }}</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-primary me-2"></i>
                            {{-- Menampilkan nomor telepon dari pengaturan --}}
                            <p class="mb-0">{{ $settings['phone_number'] ?? '(0274) 123 456' }}</p>
                        </div>
                        <div class="d-flex mt-4">
                            {{-- Nanti bisa diisi dengan link media sosial dari settings --}}
                            <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                            <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Tautan Cepat</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="{{ route('home') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-light mb-2" href="{{ route('about') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Tentang Kami</a>
                            <a class="text-light mb-2" href="{{ route('product') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Produk UMKM</a>
                            <a class="text-light mb-2" href="{{ route('blog.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Berita Desa</a>
                            <a class="text-light" href="{{ route('contact') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Kontak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid text-white" style="background: #061429;">
    <div class="container text-center">
        <div class="row justify-content-end">
            <div class="col-lg-8 col-md-6">
                <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                    <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">Desa Tuksono</a>. All Rights Reserved. </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
