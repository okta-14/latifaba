<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latifaba Group</title>

    <link rel="stylesheet" href="{{ asset('css/frontend/landingPage.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<section class="landing-page">

    <div class="overlay"></div>

    <div class="content">

        <img
            src="{{ asset('images/remove_logo.png') }}"
            class="logo"
            alt="Logo">

        <h1>LATIFABA GROUP</h1>

        <p>
            Solusi Terpercaya untuk Berbagai Bidang Usaha
        </p>

        <a href="{{ route('home') }}" class="btn-masuk">
            <span>Masuk ke Website</span>
            <span class="arrow">→</span>
        </a>


        <div class="company-wrapper">

            @foreach($members as $member)

                <a
                    href="{{ $member->url ?: '#' }}"
                    target="_blank"
                    class="company-card">

                    <img src="{{ asset($member->image) }}" alt="">

                    <h4>{{ $member->title }}</h4>

                </a>

            @endforeach

        </div>

    </div>

</section>

</body>
</html>