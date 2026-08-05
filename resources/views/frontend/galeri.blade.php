@extends('layouts.frontend')
@section('title', 'galeri')
@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/galeri.css') }}">

<header>

    <div class="breadcrumb">
        <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> {{ __('messages.nav_home') }}</a>
        <span>›</span>
        <span>{{ __('messages.nav_gallery') }}</span>
    </div>

    <div class="header-content">

        <div class="label">{{ __('messages.album_detail_label') }}</div>

        <h1>{{ __('messages.nav_gallery') }}</h1>

        <div class="subtitle">
            {{ __('messages.galeri_subtitle') }}
        </div>

    </div>

</header>

<section>

    <a href="{{ route('album') }}">
        <div class="card">

            <div class="img">
                <img src="{{ asset('images/about.png') }}" alt="Album">
            </div>

            <div class="card-body">
                <div>
                    <h3>{{ __('messages.galeri_album_title') }}</h3>
                    <p>{{ __('messages.galeri_album_desc') }}</p>
                </div>
                <div class="card-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>

        </div>
    </a>

    <a href="{{ route('videofront') }}">
        <div class="card">

            <div class="img">
                <img src="{{ asset('images/about.png') }}" alt="Video">
            </div>

            <div class="card-body">
                <div>
                    <h3>{{ __('messages.galeri_video_title') }}</h3>
                    <p>{{ __('messages.galeri_video_desc') }}</p>
                </div>
                <div class="card-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>

        </div>
    </a>

</section>

@endsection