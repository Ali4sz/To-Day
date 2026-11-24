{{--
    Shared shell for the auth screens (login & signup): the landing page's
    dark dawn-sky backdrop (star field + mountain ridges) behind an opaque
    cream card. One shell for both pages so their chrome cannot drift apart.

    Props:   $title / $heading / $subheading
    Slots:   default — the form; footer — the link row inside the card.

    The backdrop is decorative: aria-hidden, keyboard-inert, pointer-events
    none (enforced in dawn.css). Stars are generated into .hero-star-field
    by resources/js/animations.js at runtime — no page-specific JS needed.
    The ridge SVGs are byte-identical to the landing hero's.
--}}
@props([
    'title' => 'to-day',
    'heading' => '',
    'subheading' => '',
])

<x-layout class="auth-page">
    <x-slot:title>{{ $title }}</x-slot:title>

    <x-slot:head>
        {{-- Matches the dawn sky's light-mode top stop (--hero-sky-top) so
             mobile browser chrome continues the scene. Tokens are unavailable
             in meta attributes, so the value is intentionally duplicated. --}}
        <meta name="theme-color" content="#1a2044">
    </x-slot:head>

    {{-- Fixed dawn backdrop: star field + layered mountain ridges --}}
    <div class="dawn-backdrop" aria-hidden="true">
        <div class="hero-star-field"></div>
        <div class="hero-mountain-scene">
            <div class="hero-ridge hero-ridge--far">
                <svg viewBox="0 0 1440 320" preserveAspectRatio="none" focusable="false" aria-hidden="true">
                    <path d="M0,320 L0,236 C 130,220 240,180 340,156 C 420,138 500,152 590,186 C 680,214 760,214 850,186 C 940,152 1020,138 1100,156 C 1200,180 1310,220 1440,236 L1440,320 Z"></path>
                </svg>
            </div>
            <div class="hero-ridge hero-ridge--middle">
                <svg viewBox="0 0 1440 320" preserveAspectRatio="none" focusable="false" aria-hidden="true">
                    <path d="M0,320 L0,258 C 170,246 330,222 490,200 C 610,184 720,180 830,188 C 950,198 1110,224 1270,244 C 1330,250 1390,255 1440,258 L1440,320 Z"></path>
                </svg>
            </div>
            <div class="hero-ridge hero-ridge--foreground">
                <svg viewBox="0 0 1440 320" preserveAspectRatio="none" focusable="false" aria-hidden="true">
                    <path d="M0,320 L0,244 C 210,233 390,210 530,172 C 620,148 672,124 720,116 C 768,124 820,148 910,172 C 1050,210 1230,233 1440,244 L1440,320 Z"></path>
                </svg>
            </div>
        </div>
    </div>

    <main class="auth-main">
        <a href="{{ route('home') }}" class="landing-logo auth-logo" aria-label="to-day — back to the homepage">
            to<span class="landing-logo-accent">day</span>
        </a>

        <div class="auth-card">
            <div class="auth-card-header">
                <h1 class="auth-card-title">{{ $heading }}</h1>
                @if ($subheading !== '')
                    <p class="auth-card-subtitle">{{ $subheading }}</p>
                @endif
            </div>

            {{ $slot }}

            @isset($footer)
                <div class="auth-card-footer">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </main>
</x-layout>
