@extends('users.layouts.app')

@section('title', $post->title) {{-- Judul halaman dinamis --}}

@section('content')
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Detail Blog</h1>
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
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="mb-5">
                        @if($post->image)
                        <img class="img-fluid w-100 rounded mb-5" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @endif
                        <h1 class="mb-4">{{ $post->title }}</h1>
                        <div class="d-flex mb-4">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>{{ $post->author->name ?? 'Admin' }}</small>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>{{ $post->published_at->format('d M, Y') }}</small>
                        </div>
                        <div style="white-space: pre-wrap; font-size: 1.1rem; line-height: 1.8;">{!! nl2br(e($post->content)) !!}</div>
                    </div>
                    <!-- Blog Detail End -->

                    <!-- Comment List Start -->
                    <div class="mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">{{ $post->comments->count() }} Komentar</h3>
                        </div>
                        @forelse($post->comments as $comment)
                        <div class="d-flex mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random" class="img-fluid rounded" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="#">{{ $comment->user->name }}</a> <small><i>{{ $comment->created_at->format('d M Y') }}</i></small></h6>
                                <p>{{ $comment->body }}</p>
                            </div>
                        </div>
                        @empty
                        <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        @endforelse
                    </div>
                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <div class="bg-light rounded p-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Tinggalkan Komentar</h3>
                        </div>
                        @auth
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="row g-3">
                                <div class="col-12">
                                    <textarea name="comment_body" class="form-control bg-white border-0 @error('comment_body') is-invalid @enderror" rows="5" placeholder="Tulis komentar Anda..." required></textarea>
                                    @error('comment_body')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Kirim Komentar</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="alert alert-info">
                            Silakan <a href="{{ route('login') }}" class="alert-link">login</a> untuk meninggalkan komentar.
                        </div>
                        @endauth
                    </div>
                    <!-- Comment Form End -->
                </div>

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    {{-- ... (sidebar Anda tetap sama) ... --}}
                    <!-- Recent Post Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Postingan Terbaru</h3>
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
