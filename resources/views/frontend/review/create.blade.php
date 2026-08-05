@extends('layouts.frontend')
@section('title', __('messages.review_page_title'))

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/review.css') }}">

<section class="review-page">

    <div class="review-card">

        {{-- Dekorasi --}}
        <div class="top-wave"></div>
        <div class="bottom-wave"></div>

        {{-- Header --}}
        <div class="review-header">

            <span class="review-subtitle">
                {{ __('messages.review_subtitle') }}
            </span>

            <h1>{{ __('messages.review_title') }}</h1>

            <p>
               {{ __('messages.review_desc') }}
            </p>

        </div>


        {{-- Error --}}
        @if ($errors->any())

        <div class="review-alert">

            <strong>{{ __('messages.review_error_title') }}</strong>

            <ul>

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif


        <form action="{{ route('review.store') }}" method="POST">

            @csrf


            {{-- Nama --}}

            <div class="input-box">

                <label>{{ __('messages.review_label_nama') }}</label>

                <div class="input-field">

                    <i class="fa-solid fa-user"></i>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="{{ __('messages.review_placeholder_nama') }}"
                        required>

                </div>

            </div>


            {{-- Pekerjaan --}}

            <div class="input-box">

                <label>{{ __('messages.review_label_pekerjaan') }}</label>

                <div class="input-field">

                    <i class="fa-solid fa-briefcase"></i>

                    <input
                        type="text"
                        name="pekerjaan"
                        value="{{ old('pekerjaan') }}"
                        placeholder="{{ __('messages.review_placeholder_pekerjaan') }}"
                        required>

                </div>

            </div>


            {{-- Rating --}}

            <div class="input-box">

                <label>{{ __('messages.review_label_rating') }}</label>

                <input
                    type="hidden"
                    name="stars"
                    id="stars"
                    value="{{ old('stars') }}">

                <div class="rating-stars">

                    @for($i=1;$i<=5;$i++)

                    <button
                        type="button"
                        class="rating-star"
                        data-rating="{{ $i }}">

                        <i class="fa-regular fa-star"></i>

                    </button>

                    @endfor

                </div>

                <small id="ratingText">
                    {{ __('messages.review_rating_placeholder') }}
                </small>

            </div>


            {{-- Review --}}

            <div class="input-box">

                <label>{{ __('messages.review_label_review') }}</label>

                <div class="textarea-field">

                    <textarea
                        name="review"
                        rows="6"
                        placeholder="{{ __('messages.review_placeholder_review') }}"
                        required>{{ old('review') }}</textarea>

                </div>

            </div>


            {{-- Info --}}

            <div class="review-info">

                <i class="fa-solid fa-circle-info"></i>

                <span>
                    {{ __('messages.review_info') }}
                </span>

            </div>


            {{-- Tombol --}}

            <div class="review-buttons">

                <a href="{{ route('home') }}" class="btn-back">
                    {{ __('messages.review_btn_back') }}
                </a>

                <button
                    type="submit"
                    class="btn-submit">

                    <i class="fa-solid fa-paper-plane"></i>

                    {{ __('messages.review_btn_submit') }}

                </button>
                
            </div>

        </form>

    </div>

</section>



<script>

document.addEventListener('DOMContentLoaded',function(){

const stars=document.querySelectorAll('.rating-star');
const starsInput=document.getElementById('stars');
const ratingText=document.getElementById('ratingText');

const ratingLabels={
1:'{{ __('messages.review_rating_1') }}',
2:'{{ __('messages.review_rating_2') }}',
3:'{{ __('messages.review_rating_3') }}',
4:'{{ __('messages.review_rating_4') }}',
5:'{{ __('messages.review_rating_5') }}'
};

function setStars(rating){

stars.forEach(function(star){

const value=parseInt(star.dataset.rating);

const icon=star.querySelector('i');

if(value<=rating){

icon.classList.remove('fa-regular');
icon.classList.add('fa-solid');

star.classList.add('active');

}else{

icon.classList.remove('fa-solid');
icon.classList.add('fa-regular');

star.classList.remove('active');

}

});

}

stars.forEach(function(star){

star.addEventListener('click',function(){

const rating=parseInt(this.dataset.rating);

starsInput.value=rating;

setStars(rating);

ratingText.innerHTML=rating+" / 5 - "+ratingLabels[rating];

});

});

const oldRating=parseInt(starsInput.value);

if(oldRating){

setStars(oldRating);

ratingText.innerHTML=oldRating+" / 5 - "+ratingLabels[oldRating];

}

});

</script>

@endsection