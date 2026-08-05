@extends('layouts.frontend')
@section('title' , 'house')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/member.css') }}">

    <div class="name">Latifaba Members</div>

    <div class="business-list-member">

    @foreach($members as $member)

        <a
            href="{{ $member->url }}"
            class="business-card"
            target="_blank"
            rel="noopener noreferrer"
        >

            <img
                src="{{ asset($member->image) }}"
                alt="{{ $member->title }}"
            >

            <h3>{{ $member->title }}</h3>

        </a>

    @endforeach

</div>
</section>