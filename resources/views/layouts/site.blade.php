<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? config('app.name', 'INAMAN Tauhu Bergedil') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus+jakarta+sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-brand-cream text-brand-brown">
        @php
            $whatsapp = \App\Models\SiteSetting::get('whatsapp', '601131441795');
        @endphp

        <header class="sticky top-0 z-40 border-b border-brand-brown/5 bg-brand-cream/90 backdrop-blur">
            <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3 sm:px-6">
                <x-brand-mark />
                <nav class="hidden items-center gap-7 text-sm font-semibold text-brand-brown/80 md:flex">
                    <a href="{{ route('home') }}" class="transition hover:text-brand-gold-dark">Utama</a>
                    <a href="{{ route('menu.index') }}" class="transition hover:text-brand-gold-dark">Menu</a>
                    <a href="{{ route('blog.index') }}" class="transition hover:text-brand-gold-dark">Resepi & Kisah</a>
                    <a href="{{ route('contact') }}" class="transition hover:text-brand-gold-dark">Hubungi</a>
                </nav>
                <div class="flex items-center gap-2">
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener" class="btn-green text-sm !px-4 !py-2.5">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Tempah Sekarang
                    </a>
                </div>
            </div>
            <nav class="flex items-center justify-center gap-6 border-t border-brand-brown/5 bg-white/50 py-2 text-sm font-semibold text-brand-brown/80 md:hidden">
                <a href="{{ route('home') }}" class="hover:text-brand-gold-dark">Utama</a>
                <a href="{{ route('menu.index') }}" class="hover:text-brand-gold-dark">Menu</a>
                <a href="{{ route('blog.index') }}" class="hover:text-brand-gold-dark">Resepi</a>
                <a href="{{ route('contact') }}" class="hover:text-brand-gold-dark">Hubungi</a>
            </nav>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="mt-20 bg-brand-brown text-brand-cream/80">
            <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-3">
                <div>
                    <x-brand-mark />
                    <p class="mt-4 max-w-xs text-sm leading-relaxed">
                        {{ \App\Models\SiteSetting::get('about_text', 'Tauhu bergedil buatan tangan, rangup & padat isi. Buatan sendiri dengan kasih sayang di Sungai Buloh.') }}
                    </p>
                </div>
                <div>
                    <h4 class="mb-4 text-sm font-bold uppercase tracking-widest text-brand-gold">Pautan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('menu.index') }}" class="transition hover:text-brand-gold">Menu Pakej</a></li>
                        <li><a href="{{ route('blog.index') }}" class="transition hover:text-brand-gold">Resepi & Kisah</a></li>
                        <li><a href="{{ route('contact') }}" class="transition hover:text-brand-gold">Hubungi Kami</a></li>
                        <li><a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener" class="transition hover:text-brand-gold">Tempah WhatsApp</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 text-sm font-bold uppercase tracking-widest text-brand-gold">Kunjungi Kami</h4>
                    <address class="space-y-3 text-sm not-italic leading-relaxed">
                        <p>{{ \App\Models\SiteSetting::get('address') }}</p>
                        <p><a href="tel:{{ preg_replace('/\D/', '', \App\Models\SiteSetting::get('phone')) }}" class="transition hover:text-brand-gold">{{ \App\Models\SiteSetting::get('phone') }}</a></p>
                        <p>{{ \App\Models\SiteSetting::get('hours') }}</p>
                    </address>
                </div>
            </div>
            <div class="border-t border-white/10 py-5 text-center text-xs text-brand-cream/50">
                © {{ date('Y') }} <span class="font-semibold text-brand-gold">{{ \App\Models\SiteSetting::get('brand_name') }}</span>. Dibuat dengan <span class="text-brand-gold">▪</span> di Sungai Buloh. Tempahan majlis & walk-in dialu-alukan.
            </div>
        </footer>
    </body>
</html>