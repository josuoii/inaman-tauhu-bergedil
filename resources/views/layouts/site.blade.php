<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'INAMAN Tauhu Bergedil') }}</title>
        <meta name="description" content="{{ $description ?? 'Tauhu bergedil buatan tangan — rangup & padat isi. Buatan sendiri dengan kasih sayang di Sungai Buloh. Tempah sekarang.' }}">

        {{-- Fonts: Plus Jakarta Sans (brand) + Lora (editorial serif) --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus+jakarta+sans:400,500,600,700,800&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Inline critical CSS for header --}}
        <style>
            #site-header { transition: box-shadow 0.4s ease, background-color 0.4s ease; }
            #site-header.scrolled {
                box-shadow: 0 4px 24px -8px rgba(59,34,8,0.14);
                background-color: rgba(251,245,230,0.97);
            }
            #wa-float-btn { transition: opacity 0.4s ease, transform 0.4s cubic-bezier(0.22,1,0.36,1); }
        </style>
    </head>
    <body class="font-sans antialiased bg-brand-cream text-brand-brown overflow-x-hidden">

        {{-- Preloader --}}
        <x-preloader />

        @php
            $whatsapp = \App\Models\SiteSetting::get('whatsapp', '601131441795');
        @endphp

        {{-- ═══════════════════════════════════════════════════════
             HEADER
        ════════════════════════════════════════════════════════ --}}
        <header id="site-header" class="sticky top-0 z-40 border-b border-brand-brown/[0.06] bg-brand-cream/[0.92] backdrop-blur-md">
            <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3.5 sm:px-6">

                {{-- Logo --}}
                <x-brand-mark />

                {{-- Desktop nav --}}
                <nav class="hidden items-center gap-8 md:flex" aria-label="Navigasi utama">
                    <a href="{{ route('home') }}"       class="nav-link">Utama</a>
                    <a href="{{ route('menu.index') }}" class="nav-link">Menu</a>
                    <a href="{{ route('blog.index') }}" class="nav-link">Resepi & Kisah</a>
                    <a href="{{ route('contact') }}"    class="nav-link">Hubungi</a>
                </nav>

                {{-- Desktop CTA --}}
                <div class="hidden items-center gap-3 md:flex">
                    <a href="https://wa.me/{{ $whatsapp }}"
                       target="_blank" rel="noopener"
                       class="btn-green text-sm !px-5 !py-2.5">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Tempah Sekarang
                    </a>
                </div>

                {{-- Mobile: hamburger --}}
                <button id="nav-open" type="button" aria-label="Buka menu"
                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-brand-brown/10 bg-white/70 text-brand-brown transition hover:border-brand-gold/40 md:hidden">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                        <path d="M4 6h16M4 12h16M4 18h10"/>
                    </svg>
                </button>
            </div>
        </header>

        {{-- ═══════════════════════════════════════════════════════
             MOBILE DRAWER + OVERLAY
        ════════════════════════════════════════════════════════ --}}
        {{-- Overlay --}}
        <div id="drawer-overlay"
             class="fixed inset-0 z-50 bg-brand-brown/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300"
             aria-hidden="true"></div>

        {{-- Drawer panel --}}
        <aside id="mobile-drawer"
               class="fixed inset-y-0 right-0 z-50 flex w-72 translate-x-full flex-col bg-brand-cream shadow-[−8px_0_40px_-8px_rgba(59,34,8,0.25)] transition-transform duration-300 ease-[cubic-bezier(0.22,1,0.36,1)]"
               aria-label="Menu navigasi mudah alih">

            {{-- Drawer header --}}
            <div class="flex items-center justify-between border-b border-brand-brown/[0.08] px-5 py-4">
                <span class="text-xs font-bold uppercase tracking-[0.18em] text-brand-gold-dark">Menu</span>
                <button id="nav-close" type="button" aria-label="Tutup menu"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-brand-brown/10 text-brand-brown transition hover:border-brand-gold/40">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Drawer nav links --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6">
                <ul class="space-y-1">
                    @foreach([
                        ['home',        'Utama',          'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z'],
                        ['menu.index',  'Menu Pakej',     'M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3M3 16v3a2 2 0 0 0 2 2h3m11 0h3a2 2 0 0 0 2-2v-3'],
                        ['blog.index',  'Resepi & Kisah', 'M4 19.5A2.5 2.5 0 0 1 6.5 17H20'],
                        ['contact',     'Hubungi Kami',   'M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 15.1a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.11 2h3a2 2 0 0 1 2 1.72'],
                    ] as [$route, $label, $icon])
                    <li>
                        <a href="{{ route($route) }}"
                           class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-semibold text-brand-brown/80 transition hover:bg-brand-gold/10 hover:text-brand-brown">
                            <svg class="h-5 w-5 shrink-0 text-brand-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="{{ $icon }}"/>
                            </svg>
                            {{ $label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Drawer footer CTA --}}
            <div class="border-t border-brand-brown/[0.08] p-4">
                <a href="https://wa.me/{{ $whatsapp }}"
                   target="_blank" rel="noopener"
                   class="btn-green w-full text-sm">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Tempah Sekarang
                </a>
            </div>
        </aside>

        {{-- ═══════════════════════════════════════════════════════
             MAIN CONTENT
        ════════════════════════════════════════════════════════ --}}
        <main>
            {{ $slot }}
        </main>

        {{-- ═══════════════════════════════════════════════════════
             FLOATING WHATSAPP CTA
        ════════════════════════════════════════════════════════ --}}
        <a id="wa-float-btn"
           href="https://wa.me/{{ $whatsapp }}?text={{ urlencode('Assalamualaikum, saya ingin bertanya berkenaan tauhu bergedil INAMAN.') }}"
           target="_blank" rel="noopener"
           aria-label="Hubungi kami di WhatsApp"
           class="wa-float opacity-0 translate-y-6 pointer-events-none">
            <span class="wa-float-ring" aria-hidden="true"></span>
            <svg class="relative h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>

        {{-- ═══════════════════════════════════════════════════════
             FOOTER
        ════════════════════════════════════════════════════════ --}}
        <footer class="relative mt-24 overflow-hidden bg-brand-brown text-brand-cream/80">

            {{-- Decorative top edge --}}
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-brand-gold/30 to-transparent"></div>

            {{-- Footer body --}}
            <div class="mx-auto grid max-w-6xl gap-12 px-4 pt-14 pb-10 sm:px-6 md:grid-cols-3">

                {{-- Col 1: Brand --}}
                <div>
                    <x-brand-mark on-dark />
                    <p class="mt-5 max-w-xs text-sm leading-relaxed text-brand-cream/60 text-pretty">
                        {{ \App\Models\SiteSetting::get('about_text', 'Tauhu bergedil buatan tangan, rangup & padat isi. Buatan sendiri dengan kasih sayang di Sungai Buloh.') }}
                    </p>
                    {{-- Social placeholder --}}
                    <div class="mt-6 flex gap-3">
                        <a href="#" aria-label="Facebook INAMAN"
                           class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 text-brand-cream/50 transition hover:border-brand-gold/40 hover:text-brand-gold">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3l-.5 3H13v6.8c4.56-.93 8-4.96 8-9.8z"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram INAMAN"
                           class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 text-brand-cream/50 transition hover:border-brand-gold/40 hover:text-brand-gold">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener" aria-label="WhatsApp INAMAN"
                           class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 text-brand-cream/50 transition hover:border-brand-green-light/40 hover:text-brand-green-light">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Col 2: Links --}}
                <div>
                    <h4 class="mb-5 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-brand-gold">Pautan</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('menu.index') }}" class="link-lined text-brand-cream/65 hover:text-brand-cream transition-colors">
                                Menu Pakej
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}" class="link-lined text-brand-cream/65 hover:text-brand-cream transition-colors">
                                Resepi & Kisah
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="link-lined text-brand-cream/65 hover:text-brand-cream transition-colors">
                                Hubungi Kami
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener" class="link-lined text-brand-cream/65 hover:text-brand-cream transition-colors">
                                Tempah via WhatsApp
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Col 3: Contact --}}
                <div>
                    <h4 class="mb-5 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-brand-gold">Kunjungi Kami</h4>
                    <address class="space-y-3.5 text-sm not-italic">
                        <p class="flex gap-3 text-brand-cream/65 leading-relaxed">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand-gold/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>
                            </svg>
                            {{ \App\Models\SiteSetting::get('address') }}
                        </p>
                        <p class="flex gap-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand-gold/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/\D/', '', \App\Models\SiteSetting::get('phone')) }}"
                               class="text-brand-cream/65 transition hover:text-brand-gold">
                                {{ \App\Models\SiteSetting::get('phone') }}
                            </a>
                        </p>
                        <p class="flex gap-3 text-brand-cream/65">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand-gold/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                            </svg>
                            {{ \App\Models\SiteSetting::get('hours') }}
                        </p>
                    </address>
                </div>
            </div>

            {{-- Footer bottom bar --}}
            <div class="border-t border-white/[0.06] py-5 text-center text-xs text-brand-cream/35">
                <div class="mb-1.5 h-px w-24 mx-auto bg-gradient-to-r from-transparent via-brand-gold/20 to-transparent"></div>
                © {{ date('Y') }} <span class="font-semibold text-brand-gold/70">{{ \App\Models\SiteSetting::get('brand_name') }}</span>.
                Dibuat dengan ♥ di Sungai Buloh.
            </div>
        </footer>

    </body>
</html>