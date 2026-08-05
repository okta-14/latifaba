@extends('layouts.frontend')
@section('title', $album->title)

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/albumDetail.css') }}">

<!-- HERO -->
<section class="album-hero">

    <div class="container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('messages.nav_home') }}</a>
            <span>›</span>

            <a href="{{ route('album') }}">{{ __('messages.nav_gallery') }}</a>
            <span>›</span>

            <span>{{ $album->title }}</span>
        </div>

        <div class="hero-left">

            <div class="label">
                {{ __('messages.album_detail_label') }}
            </div>

            <h1>{{ $album->title }}</h1>

            <div class="hero-meta">

                <div>
                    <i class="fa-regular fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($album->date)->translatedFormat('d F Y') }}
                </div>

                <div>
                    <i class="fa-regular fa-image"></i>
                    {{ $album->fotos->count() }} {{ __('messages.album_photo_count') }}
                </div>

                <div>
                    <i class="fa-regular fa-eye"></i>
                    {{ $album->hit }} {{ __('messages.album_views') }}
                </div>

            </div>

        </div>

    </div>

</section>

<!-- GALLERY -->

<section class="gallery">

    <div class="container">

        <div class="section-title">

            <span></span>

            <h2>{{ __('messages.album_photo_gallery') }}</h2>

        </div>

        <div class="gallery-grid">

            @forelse($album->fotos as $foto)

            <div class="gallery-item">

                <img src="{{ asset($foto->img) }}" alt="">

            </div>

            @empty

            <div class="empty">
                {{ __('messages.album_no_photos') }}
            </div>

            @endforelse

        </div>

    </div>

</section>

@endsection