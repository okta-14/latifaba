@php
    $pengaturan = \App\Models\Pengaturan::first();
    $services = \App\Models\Service::where('status', 'Show')->get();
    $medias = \App\Models\Media::all();

    $wa = '';

    if ($pengaturan && $pengaturan->phone) {
        $wa = preg_replace('/[^0-9]/', '', $pengaturan->phone);

        if (substr($wa, 0, 1) == '0') {
            $wa = '62' . substr($wa, 1);
        }
    }
@endphp

<footer class="footer">

    <div class="footer-container" id="footer">

        <!-- Company -->
        <div class="footer-company">

            <img src="{{ asset('images/remove_logo.png') }}" alt="Latifaba Group">

            <p>
                {{ __('messages.footer_about') }}
            </p>

            <div class="social-media">

                @foreach ($medias as $media)

                    @php
                        $icon = 'fa-solid fa-globe';

                        switch (strtolower($media->title)) {
                            case 'instagram':
                                $icon = 'fa-brands fa-instagram';
                                break;

                            case 'facebook':
                                $icon = 'fa-brands fa-facebook-f';
                                break;

                            case 'linkedin':
                                $icon = 'fa-brands fa-linkedin-in';
                                break;

                            case 'youtube':
                                $icon = 'fa-brands fa-youtube';
                                break;

                            case 'twitter':
                            case 'x':
                                $icon = 'fa-brands fa-x-twitter';
                                break;

                            case 'tiktok':
                                $icon = 'fa-brands fa-tiktok';
                                break;

                            case 'telegram':
                                $icon = 'fa-brands fa-telegram';
                                break;

                            case 'github':
                                $icon = 'fa-brands fa-github';
                                break;

                            case 'whatsapp':
                                $icon = 'fa-brands fa-whatsapp';
                                break;
                        }
                    @endphp

                    <a href="{{ $media->url }}" target="_blank">
                        <i class="{{ $icon }}"></i>
                    </a>

                @endforeach

            </div>

        </div>

        <!-- Sitemap -->
        <div class="footer-menu">

            <h3>{{ __('messages.footer_sitemap') }}</h3>

            <ul>

                <li>
                    <a href="{{ route('landingPage') }}">
                        <i class="fa-solid fa-chevron-right"></i> {{ __('messages.nav_home') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('landingPage') }}#about">
                        <i class="fa-solid fa-chevron-right"></i> {{ __('messages.nav_about') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('members') }}">
                        <i class="fa-solid fa-chevron-right"></i> {{ __('messages.nav_members') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('program') }}">
                        <i class="fa-solid fa-chevron-right"></i> {{ __('messages.footer_programs') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('blog') }}">
                        <i class="fa-solid fa-chevron-right"></i> {{ __('messages.nav_news') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('galeri') }}">
                        <i class="fa-solid fa-chevron-right"></i> {{ __('messages.footer_galeri') }}
                    </a>
                </li>

            </ul>

        </div>

        <!-- Services -->
        <div class="footer-menu">

            <h3>{{ __('messages.footer_services') }}</h3>

            <ul>
                @foreach($services as $service)
                    <li>
                        <a href="{{ $service->url ?: '#' }}" target="{{ $service->url ? '_blank' : '_self' }}">
                            <i class="fa-solid fa-chevron-right"></i>
                            {{ $service->title }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

        <!-- Contact -->
        <div class="footer-contact">

            <h3>{{ __('messages.footer_contact_us') }}</h3>

            <p>
                <i class="fa-solid fa-location-dot"></i>

                {{ $pengaturan->address ?? '-' }}

            </p>

            <p>
                <i class="fa-solid fa-phone"></i>

                @if($wa)

                    <a href="https://wa.me/{{ $wa }}" target="_blank">

                        {{ $pengaturan->phone }}

                    </a>

                @else

                    -

                @endif

            </p>

            <p>
                <i class="fa-solid fa-envelope"></i>

                @if(!empty($pengaturan->email))

                    <a href="mailto:{{ $pengaturan->email }}">

                        {{ $pengaturan->email }}

                    </a>

                @else

                    -

                @endif

            </p>

            <p>
                <i class="fa-solid fa-globe"></i>

                @if(!empty($pengaturan->website))

                    <a href="{{ $pengaturan->website }}" target="_blank">

                        {{ $pengaturan->website }}

                    </a>

                @else

                    -

                @endif

            </p>

        </div>

    </div>

    <div class="footer-bottom">

        <p>

            © {{ date('Y') }}
            {{ $pengaturan->copyright ?? 'LATIFABA GROUP' }}

        </p>

        <p>

            {{ __('messages.footer_designed_by') }}
            <strong>INDO APPS SOLUSINDO</strong>

        </p>

    </div>

</footer>