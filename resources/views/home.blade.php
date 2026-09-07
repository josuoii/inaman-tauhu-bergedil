<x-site-layout :title="__('INAMAN Tauhu Bergedil — Rangup, Padat Isi, Buatan Tangan')">
@php
    $whatsapp = \App\Models\SiteSetting::get('whatsapp', '601131441795');
    $waHref   = "https://wa.me/{$whatsapp}";
@endphp

{{-- ═══════════════════════════════════════════════════════════════════════════
     HERO SECTION
════════════════════════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden">

    {{-- Atmospheric glow orbs --}}
    <div class="pointer-events-none absolute -top-32 -right-32 h-[500px] w-[500px] rounded-full bg-brand-gold/10 blur-[80px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute bottom-0 -left-32 h-[400px] w-[400px] rounded-full bg-brand-parchment/60 blur-[60px]" aria-hidden="true"></div>

    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:py-24">

        {{-- LEFT: Copy --}}
        <div class="animate-fade-up">

            {{-- Eyebrow --}}
            <p class="eyebrow">
                Buatan tangan &middot; Sungai Buloh
            </p>

            {{-- Headline --}}
            <h1 class="section-title-lg mt-5 text-balance">
                Rangup di luar,<br>
                <span class="text-gold-gradient">padat isi</span> di dalam.
            </h1>

            {{-- Subtext --}}
            <p class="mt-5 max-w-md text-base leading-relaxed text-brand-brown/65 text-pretty sm:text-lg">
                {{ \App\Models\SiteSetting::get('tagline', 'Tauhu bergedil buatan tangan — ayam & daging, digoreng sehingga garing keemasan.') }}
            </p>

            {{-- CTAs --}}
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="{{ route('menu.index') }}" class="btn-primary">
                    Lihat Menu
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </a>
                <a href="{{ $waHref }}?text={{ urlencode('Assalamualaikum, saya nak tanya pasal tauhu bergedil INAMAN.') }}"
                   target="_blank" rel="noopener"
                   class="btn-outline">
                    <svg class="h-4 w-4 text-brand-green" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Tanya via WhatsApp
                </a>
            </div>

            {{-- Stats row --}}
            <dl class="mt-12 flex flex-wrap gap-8 border-t border-brand-brown/[0.08] pt-8">
                <div>
                    <dt class="stat-value">
                        <span data-counter data-target="100" data-suffix="%" data-duration="1400">100%</span>
                    </dt>
                    <dd class="stat-label">Homemade fresh</dd>
                </div>
                <div class="h-auto w-px bg-brand-brown/10" aria-hidden="true"></div>
                <div>
                    <dt class="stat-value">
                        <span data-counter data-target="{{ $featured->count() }}" data-suffix="+" data-duration="900">{{ $featured->count() }}+</span>
                    </dt>
                    <dd class="stat-label">Pakej pilihan</dd>
                </div>
                <div class="h-auto w-px bg-brand-brown/10" aria-hidden="true"></div>
                <div>
                    <dt class="stat-value text-brand-gold-dark">Walk-in</dt>
                    <dd class="stat-label">& Tempahan Majlis</dd>
                </div>
            </dl>
        </div>

        {{-- RIGHT: Hero image --}}
        <div class="relative animate-fade-up animate-delay-3">
            {{-- Decorative dashed ring --}}
            <div class="absolute -inset-4 rounded-[2.5rem] border border-dashed border-brand-gold/35" aria-hidden="true"></div>

            {{-- Main image --}}
            <div class="relative overflow-hidden rounded-[2rem] shadow-lift">
                <img src="{{ asset('images/hero.jpg') }}"
                     alt="Tauhu bergedil INAMAN — rangup luar, padat isi"
                     class="aspect-[4/3] w-full object-cover transition-transform duration-700 hover:scale-[1.03]"
                     width="600" height="450">
                {{-- Warm overlay on hover --}}
                <div class="absolute inset-0 bg-gradient-to-br from-brand-gold/0 to-brand-brown/0 transition-all duration-500 hover:from-brand-gold/[0.06] hover:to-brand-brown/20 rounded-[2rem]"></div>
            </div>

            {{-- Floating badge: social proof --}}
            <div class="absolute -bottom-5 -left-4 card-elevated flex items-center gap-3 px-4 py-3 sm:-left-7 animate-float">
                <div class="flex -space-x-1">
                    @foreach(['⭐','🌟','✨'] as $star)
                    <span class="grid h-7 w-7 place-items-center rounded-full border-2 border-white bg-brand-gold-pale text-xs" aria-hidden="true">{{ $star }}</span>
                    @endforeach
                </div>
                <div>
                    <p class="text-xs font-extrabold text-brand-brown">Disukai ramai</p>
                    <p class="text-[0.65rem] text-brand-brown/55">Rangup tak kering, isi padu</p>
                </div>
            </div>

            {{-- Floating badge: halal / quality --}}
            <div class="absolute -top-4 -right-4 sm:-right-7 card flex items-center gap-2 px-3.5 py-2.5 animate-float animate-delay-3">
                <span class="text-lg" aria-hidden="true">🤲</span>
                <div>
                    <p class="text-xs font-extrabold text-brand-brown">100% Halal</p>
                    <p class="text-[0.65rem] text-brand-brown/55">Bahan pilihan</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     MARQUEE TICKER — upgraded: dark parchment with grain
════════════════════════════════════════════════════════════════════════════ --}}
<div class="relative overflow-hidden border-y border-brand-brown/15 bg-brand-brown py-3.5" aria-hidden="true">
    {{-- Gold pinstripe top --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-brand-gold/40 to-transparent"></div>
    <div class="marquee-track gap-8 text-sm font-extrabold uppercase tracking-[0.12em]">
        @for ($i = 0; $i < 2; $i++)
            <span class="flex shrink-0 gap-8">
                <span class="text-brand-gold">Tauhu Bergedil Ayam</span>
                <span class="text-brand-gold/30">◆</span>
                <span class="text-brand-gold">Tauhu Bergedil Daging</span>
                <span class="text-brand-gold/30">◆</span>
                <span class="text-brand-gold">Popia Bergedil</span>
                <span class="text-brand-gold/30">◆</span>
                <span class="text-brand-gold">Sos Kicap Pedas</span>
                <span class="text-brand-gold/30">◆</span>
                <span class="text-brand-gold">Tempahan Majlis</span>
                <span class="text-brand-gold/30">◆</span>
            </span>
        @endfor
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-brand-gold/40 to-transparent"></div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     KISAH KAMI
════════════════════════════════════════════════════════════════════════════ --}}
<section class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:py-28">
    <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-20">

        {{-- Image --}}
        <div class="relative order-2 lg:order-1 reveal-on-scroll">
            <img src="{{ asset('images/blog/kisah.jpg') }}"
                 alt="Kisah di sebalik INAMAN"
                 class="aspect-[4/3] w-full rounded-3xl object-cover shadow-lift">

            {{-- Floating year badge --}}
            <div class="absolute -top-5 -right-5 rounded-2xl bg-brand-brown px-5 py-4 text-brand-cream shadow-lift sm:-right-7">
                <p class="font-sans text-2xl font-extrabold text-brand-gold leading-none">Sejak</p>
                <p class="mt-1 text-[0.55rem] font-bold uppercase tracking-[0.22em] text-brand-cream/55">Di Dapur Kami</p>
            </div>

            {{-- Decorative grain texture on image --}}
            <div class="absolute inset-0 rounded-3xl bg-grain pointer-events-none" aria-hidden="true"></div>
        </div>

        {{-- Copy --}}
        <div class="order-1 lg:order-2 reveal-on-scroll">
            <p class="eyebrow">Tentang Kami</p>
            <h2 class="section-title mt-4">{{ \App\Models\SiteSetting::get('about_title', 'Kisah Kami') }}</h2>
            <p class="mt-5 text-base leading-relaxed text-brand-brown/70 text-pretty">
                {{ \App\Models\SiteSetting::get('about_text') }}
            </p>
            <blockquote class="mt-7 border-l-2 border-brand-gold pl-5">
                <p class="quote-serif">"Makanan yang sedap bermula dari bahan yang betul dan tangan yang sabar."</p>
            </blockquote>
            <a href="{{ route('blog.show', 'kisah-di-sebalik-inaman') }}" class="btn-outline mt-8 text-sm">
                Baca Kisah Kami
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Soft divider --}}
<div class="section-divider mx-4 sm:mx-auto sm:max-w-6xl sm:px-6"></div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     MENU HIGHLIGHT
════════════════════════════════════════════════════════════════════════════ --}}
<section class="py-20 lg:py-28">
    {{-- Subtle background wash --}}
    <div class="relative">
        <div class="pointer-events-none absolute inset-x-0 top-0 h-full bg-brand-cream-dark/40" aria-hidden="true"></div>

        <div class="relative mx-auto max-w-6xl px-4 sm:px-6">

            {{-- Header --}}
            <div class="flex flex-wrap items-end justify-between gap-4 reveal-on-scroll">
                <div>
                    <p class="eyebrow">Favorit Ramai</p>
                    <h2 class="section-title mt-3">Menu Pilihan Kami</h2>
                </div>
                <a href="{{ route('menu.index') }}" class="btn-outline text-sm">
                    Semua Menu
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            </div>

            {{-- Cards grid --}}
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($featured as $item)
                    <article class="card group overflow-hidden reveal-on-scroll">

                        {{-- Image wrapper --}}
                        <div class="menu-card-img-wrap">
                            <img src="{{ asset(ltrim($item->image_path, '/')) }}"
                                 alt="{{ $item->name }}"
                                 loading="lazy"
                                 class="aspect-[4/3] w-full object-cover transition duration-500 ease-spring group-hover:scale-105">

                            {{-- Category badge --}}
                            <span class="absolute left-3 top-3 chip-gold">
                                {{ $item->category->name ?? 'Menu' }}
                            </span>

                            {{-- Best seller badge --}}
                            @if ($item->is_featured)
                                <span class="absolute right-3 top-3 chip-dark">
                                    🏆 Best Seller
                                </span>
                            @endif

                            {{-- Price pill overlay --}}
                            <div class="absolute bottom-3 right-3 rounded-full bg-brand-brown/80 backdrop-blur-sm px-3 py-1 text-sm font-extrabold text-brand-gold">
                                {{ $item->formatted_price }}
                            </div>
                        </div>

                        {{-- Card body --}}
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-base font-extrabold text-brand-brown">{{ $item->name }}</h3>
                                <span class="shrink-0 flex items-center gap-1.5 text-xs font-bold text-brand-brown/55">
                                    <svg class="h-3.5 w-3.5 text-brand-gold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path d="M20 7h-1.5a2 2 0 0 1-1.7-.9L15.5 4.2A2 2 0 0 0 13.8 3.5H6a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                    {{ $item->quantity }} keping
                                </span>
                            </div>
                            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-brand-brown/65">{{ $item->description }}</p>
                            <a href="{{ $waHref }}?text={{ urlencode('Assalamualaikum, saya ingin menempah ' . $item->name . ' (' . $item->quantity . ' keping).') }}"
                               target="_blank" rel="noopener"
                               class="btn-green mt-4 w-full text-sm !py-2.5">
                                Tempah via WhatsApp
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-center text-brand-brown/50">Menu belum ditambah.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     TESTIMONI — Editorial serif style
════════════════════════════════════════════════════════════════════════════ --}}
<section class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:py-28">

    <div class="text-center reveal-on-scroll">
        <p class="eyebrow">Kata Mereka</p>
        <h2 class="section-title mt-4">Pelanggan Kami Berkata</h2>
    </div>

    <div class="mt-12 grid gap-6 md:grid-cols-3">
        @foreach ([
            ['Aina',    'Beli pakej 10, sampai rumah masih rangup lagi. Sos kicap pedas dia pun sedap gila!',                       'Pelanggan setia'],
            ['Firdaus', 'Order untuk majlis pejabat, semua orang puji. Padat isi, tak kedekut inti. Confirm repeat order.',          'Pelanggan korporat'],
            ['Kak Su',  'Anak saya dah pandai minta sendiri. Setiap minggu mesti beli tauhu bergedil INAMAN.',                      'Pelanggan setia'],
        ] as [$name, $quote, $role])
            <figure class="testimonial-card reveal-on-scroll">
                {{-- Stars --}}
                <div class="flex gap-0.5 text-brand-gold" aria-label="5 bintang">
                    @for ($j = 0; $j < 5; $j++)
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/>
                        </svg>
                    @endfor
                </div>

                {{-- Large quotemark --}}
                <p class="testimonial-quotemark mt-2">"</p>

                {{-- Quote in serif --}}
                <blockquote class="testimonial-text -mt-3">{{ $quote }}</blockquote>

                {{-- Author --}}
                <figcaption class="testimonial-author mt-5">
                    <div class="testimonial-avatar">{{ $name[0] }}</div>
                    <div>
                        <p class="text-sm font-bold text-brand-brown">{{ $name }}</p>
                        <p class="text-xs text-brand-brown/45">{{ $role }}</p>
                    </div>
                </figcaption>
            </figure>
        @endforeach
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     CARA TEMPAH — dark section with step connectors
════════════════════════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-brand-brown py-20 text-brand-cream lg:py-28">

    {{-- Atmospheric glow --}}
    <div class="pointer-events-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[600px] w-[600px] rounded-full bg-brand-gold/5 blur-[120px]" aria-hidden="true"></div>

    {{-- Grain on dark section --}}
    <div class="absolute inset-0 opacity-[0.025] bg-grain pointer-events-none" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6">

        <div class="text-center reveal-on-scroll">
            <p class="eyebrow text-brand-gold/70">Mudah Je</p>
            <h2 class="mt-4 text-3xl font-extrabold tracking-tight sm:text-4xl">Cara Tempah</h2>
        </div>

        {{-- Steps --}}
        <div class="relative mt-14 grid gap-6 md:grid-cols-3">

            {{-- Connector line (desktop only) --}}
            <div class="pointer-events-none absolute top-6 left-[calc(16.67%+24px)] right-[calc(16.67%+24px)] hidden h-px bg-gradient-to-r from-brand-gold/30 via-brand-gold/50 to-brand-gold/30 md:block" aria-hidden="true"></div>

            @foreach ([
                ['01', 'Pilih Pakej',    'Tengok menu dan pilih pakej 6, 10 atau 20 keping mengikut keperluan anda.'],
                ['02', 'WhatsApp Kami',  'Tekan butang tempah, mesej terus berhubung dengan kami. Jawab pantas!'],
                ['03', 'Ambil & Hidang', 'Ambil terus di kedai atau order awal untuk majlis. Tauhu bergedil fresh setiap hari!'],
            ] as [$num, $title, $desc])
                <div class="step-card reveal-on-scroll">
                    <div class="step-number">{{ $num }}</div>
                    <h3 class="mt-5 text-lg font-extrabold text-brand-gold">{{ $title }}</h3>
                    <p class="mt-2.5 text-sm leading-relaxed text-brand-cream/65">{{ $desc }}</p>
                </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="mt-12 text-center reveal-on-scroll">
            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-primary text-sm">
                Mula Tempah Sekarang
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     LOKASI
════════════════════════════════════════════════════════════════════════════ --}}
<section class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:py-28">
    <div class="grid items-stretch gap-8 lg:grid-cols-5">

        {{-- Info card --}}
        <div class="card flex flex-col gap-5 p-7 lg:col-span-2 reveal-on-scroll">
            <p class="eyebrow">Lokasi</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-brand-brown">Kunjungi Kedai Kami</h2>

            <div class="flex-1 space-y-4 text-sm text-brand-brown/70">
                <p class="flex gap-3.5">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span>{{ \App\Models\SiteSetting::get('address') }}</span>
                </p>
                <p class="flex gap-3.5">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <a href="tel:{{ preg_replace('/\D/', '', \App\Models\SiteSetting::get('phone')) }}"
                       class="transition hover:text-brand-gold-dark">
                        {{ \App\Models\SiteSetting::get('phone') }}
                    </a>
                </p>
                <p class="flex gap-3.5">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                    <span>{{ \App\Models\SiteSetting::get('hours') }}</span>
                </p>
            </div>

            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-green mt-auto text-sm">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Dapatkan Arah & Tempah
            </a>
        </div>

        {{-- Map --}}
        <div class="overflow-hidden rounded-3xl shadow-lift ring-1 ring-brand-brown/[0.08] lg:col-span-3 reveal-on-scroll">
            <iframe src="{{ \App\Models\SiteSetting::get('map_src') }}"
                    class="h-full min-h-[340px] w-full border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi INAMAN Tauhu Bergedil"
                    allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

</x-site-layout>