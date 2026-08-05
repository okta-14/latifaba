@php
    $pengaturan = \App\Models\Pengaturan::first();

    $wa = '';

    if ($pengaturan && $pengaturan->phone) {
        $wa = preg_replace('/[^0-9]/', '', $pengaturan->phone);

        if (substr($wa, 0, 1) == '0') {
            $wa = '62' . substr($wa, 1);
        }
    }
@endphp

<nav>

    <div class="logo-latifaba">
        <img src="{{ asset('images/remove_logo.png') }}" alt="Latifaba Logo">
        <p>Latifaba Group</p>
    </div>

    <!-- Tombol Hamburger -->
    <div class="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </div>

    <!-- Menu -->
    <div class="nav-menu">
        <a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a>
        <a href="{{ route('home') }}#about">{{ __('messages.nav_about') }}</a>

        <a href="{{ route('members') }}">{{ __('messages.nav_members') }}</a>
        <a href="{{ route('program') }}">{{ __('messages.nav_program') }}</a>
        <a href="{{ route('blog') }}">{{ __('messages.nav_news') }}</a>
        <a href="{{ route('galeri') }}">{{ __('messages.nav_gallery') }}</a>

        @if($wa)
        <a href="https://wa.me/{{ $wa }}" target="_blank" class="contact-btn">
            {{ __('messages.nav_contact') }}
        </a>
        @else
        <a href="#footer" class="contact-btn">
            {{ __('messages.nav_contact') }}
        </a>
        @endif

        <div class="lang-dropdown">
            <button type="button" class="lang-dropdown-toggle" id="langToggle">
                <i class="fa-solid fa-globe"></i>
                <span>{{ strtoupper(app()->getLocale()) }}</span>
                <i class="fa-solid fa-chevron-down lang-arrow"></i>
            </button>

            <div class="lang-dropdown-menu" id="langMenu">
                <a href="{{ route('lang.switch', 'id') }}"
                   class="{{ app()->getLocale() == 'id' ? 'active' : '' }}">
                    Indonesia
                </a>
                <a href="{{ route('lang.switch', 'en') }}"
                   class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
                    English
                </a>
                <a href="{{ route('lang.switch', 'jp') }}"
                   class="{{ app()->getLocale() == 'jp' ? 'active' : '' }}">
                    日本語
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('langToggle');
    const menu = document.getElementById('langMenu');

    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.toggle('open');
        toggle.classList.toggle('open');
    });

    document.addEventListener('click', function (e) {
        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            menu.classList.remove('open');
            toggle.classList.remove('open');
        }
    });
});
</script>