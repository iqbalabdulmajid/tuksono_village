@extends('users.layouts.app')
@section('content')
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Blog</h1>
                <a href="{{ route('home') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ route('blog.index') }}" class="h5 text-white">Blog</a>
            </div>
        </div>
    </div>
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-8">
                    <div class="row g-5">
                        @forelse ($posts as $post)
                            <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                                <div class="blog-item bg-light rounded overflow-hidden h-100 d-flex flex-column">
                                    <div class="blog-img position-relative overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <div class="d-flex mb-3">
                                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>{{ $post->author->name ?? 'Admin' }}</small>
                                            <small><i class="far fa-calendar-alt text-primary me-2"></i>{{ $post->published_at->format('d M, Y') }}</small>
                                        </div>
                                        <h4 class="mb-3">{{ $post->title }}</h4>
                                        <p>{{ Str::limit(strip_tags($post->content), 120) }}</p>
                                        <a class="text-uppercase" href="{{ route('blog.show', $post->slug) }}">Read More <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center fs-4 text-muted">Belum ada postingan blog.</p>
                            </div>
                        @endforelse

                        <div class="col-12 wow slideInUp" data-wow-delay="0.1s">
                           {{-- Laravel Pagination --}}
                          {{ $posts->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
                <!-- Blog list End -->

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Search Form Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Keyword">
                            <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <!-- Search Form End -->

                    <!-- Recent Post Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Post</h3>
                        </div>
                        @foreach ($recentPosts as $recent)
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ asset('storage/' . $recent->image) }}"
                                style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $recent->title }}">
                            <a href="{{ route('blog.show', $recent->slug) }}" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">{{ $recent->title }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <!-- Recent Post End -->
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
