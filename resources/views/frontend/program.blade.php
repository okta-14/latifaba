@extends('layouts.frontend')
@section('title', 'program')

@section('content')
<link rel="stylesheet" href="{{ asset('css/frontend/program.css') }}">

<!-- ================= HEADER ================= -->
<header>
    <div class="header-content">
        <div class="blue">{{ __('messages.program_hero_label') }}</div>
        <div class="red">{{ __('messages.program_hero_title_1') }}</div>
        <div class="red">{{ __('messages.program_hero_title_2') }}</div>
    </div>
</header>

<!-- ================= Program ================= -->
<section class="program-section">

    <div class="section-title">
        <h6>{{ __('messages.program_section_title') }}</h6>
        <div class="line"></div>
    </div>

    <div class="program-filter">

        <a href="{{ route('program') }}"
           class="{{ !request('kategori') ? 'active' : '' }}">
            {{ __('messages.program_filter_all') }}
        </a>

        @foreach($categories as $category)

        <a href="{{ route('program', ['kategori' => $category->slug]) }}"
           class="{{ request('kategori')==$category->slug ? 'active' : '' }}">
            {{ $category->title }}
        </a>

        @endforeach

    </div>

    <div class="program">

        @forelse($programs as $item)

            @if($item->url)

            <a href="{{ $item->url }}"
               class="program-link"
               target="_blank"
               rel="noopener noreferrer">

                <div class="program-card">

                    <div class="program-image">
                        <img src="{{ $item->img ? asset($item->img) : asset('images/programd.png') }}"
                             alt="{{ $item->title }}">
                    </div>

                    <div class="program-content">

                        <h3 class="program-title">
                            {{ $item->title }}
                        </h3>

                        <p class="program-desc">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}
                        </p>

                        <span class="program-btn">
                            {{ __('messages.home_see_more') }}
                        </span>

                    </div>

                </div>

            </a>

            @else

            <div class="program-card">

                <div class="program-image">
                    <img src="{{ $item->img ? asset($item->img) : asset('images/programd.png') }}"
                         alt="{{ $item->title }}">
                </div>

                <div class="program-content">

                    <h3 class="program-title">
                        {{ $item->title }}
                    </h3>

                    <p class="program-desc">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}
                    </p>

                </div>

            </div>

            @endif

        @empty

        <p class="text-center w-100">{{ __('messages.program_no_program') }}</p>

        @endforelse

    </div>

</section>
@endsection