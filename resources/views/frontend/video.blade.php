@extends('layouts.frontend')
@section('title', 'Video')
@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/vidio.css') }}">

<header>
    <div class="header-content">
        <h6>{{ __('messages.video_page_title') }}</h6>
        <div class="line"></div>
    </div>
</header>

<section class="video-container">

    @foreach($videos as $video)

    @php
        $youtubeId = '';

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{11})/', $video->source, $match)) {
            $youtubeId = $match[1];
        }
    @endphp

    <div class="vidio-card">

        @if($youtubeId)

            {{-- Wrapper video: awalnya berisi thumbnail + tombol play.
                 Iframe YouTube baru dibuat saat user klik (lazy load),
                 supaya video tidak pernah "hilang" saat refresh dan
                 hit selalu tercatat tepat saat user klik play. --}}
            <div
                class="video-embed"
                id="videoEmbed{{ $video->id }}"
                data-video-id="{{ $video->id }}"
                data-youtube-id="{{ $youtubeId }}"
                data-hit-url="{{ route('videofront.hit', $video->id) }}"
                style="position:relative;width:100%;aspect-ratio:16/9;cursor:pointer;overflow:hidden;background:#000;"
            >
                <img
                    src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg"
                    alt="{{ $video->title }}"
                    style="width:100%;height:100%;object-fit:cover;display:block;"
                    loading="lazy"
                >

                <div
                    class="video-play-btn"
                    style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
                           width:64px;height:64px;border-radius:50%;background:rgba(0,0,0,.65);
                           display:flex;align-items:center;justify-content:center;
                           color:#fff;font-size:26px;pointer-events:none;"
                >
                    ▶
                </div>
            </div>

        @else

            <div class="alert alert-danger">
                {{ __('messages.video_invalid_link') }}
            </div>

        @endif

        <div class="category">{{ __('messages.video_page_title') }}</div>

        <div class="title">
            {{ $video->title }}
        </div>

        <div class="date">
            {{ \Carbon\Carbon::parse($video->date)->translatedFormat('d F Y') }}
        </div>

    </div>

    @endforeach

</section>

<script>

let sudahHit = {};

document.querySelectorAll('.video-embed').forEach(function (wrapper) {

    wrapper.addEventListener('click', function () {

        const videoId    = wrapper.dataset.videoId;
        const youtubeId  = wrapper.dataset.youtubeId;
        const hitUrl     = wrapper.dataset.hitUrl;

        // 1. Catat hit — langsung saat diklik, tidak bergantung API YouTube
        tambahHit(videoId, hitUrl);

        // 2. Ganti thumbnail dengan iframe video yang langsung autoplay
        wrapper.innerHTML = `
            <iframe
                width="100%"
                height="100%"
                src="https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                style="position:absolute;top:0;left:0;width:100%;height:100%;">
            </iframe>
        `;

        wrapper.style.cursor = 'default';

    }, { once: true }); // klik pertama saja yang perlu di-handle untuk swap thumbnail → iframe

});

function tambahHit(id, hitUrl) {

    if (sudahHit[id]) return;

    sudahHit[id] = true;

    fetch(hitUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(function (res) {
        console.log('[hit] status:', res.status);
        return res.json();
    })
    .then(function (data) {
        console.log('[hit] response:', data);
    })
    .catch(function (err) {
        console.error('[hit] gagal:', err);
    });

}

</script>

@endsection