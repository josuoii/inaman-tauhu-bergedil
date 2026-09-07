<x-site-layout :title="__('INAMAN Tauhu Bergedil — Rangup, Padat Isi')">
    @php
        $whatsapp = \App\Models\SiteSetting::get('whatsapp', '601131441795');
        $waHref = "https://wa.me/{$whatsapp}";
    @endphp

    {{-- HERO --}}
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -top-24 -right-24 h-96 w-96 rounded-full bg-brand-gold/20 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 -left-24 h-80 w-80 rounded-full bg-brand-gold-light/40 blur-3xl"></div>

        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-14 sm:px-6 lg:grid-cols-2 lg:py-20">
            <div class="animate-fade-up">
                <span class="chip bg-brand-brown text-brand-gold">Buatan tangan • Sungai Buloh</span>
                <h1 class="mt-5 text-4xl font-extrabold leading-[1.08] tracking-tight text-brand-brown text-balance sm:text-5xl lg:text-6xl">
                    Rangup di luar,<br>
                    <span class="text-brand-gold-dark">padat isi</span> di dalam.
                </h1>
                <p class="mt-5 max-w-md text-base leading-relaxed text-brand-brown/70 sm:text-lg">
                    {{ \App\Models\SiteSetting::get('tagline', 'Tauhu bergedil buatan tangan — ayam & daging, digoreng sehingga garing keemasan.') }}
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('menu.index') }}" class="btn-primary">
                        Lihat Menu
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                    <a href="{{ $waHref }}?text={{ urlencode('Assalamualaikum, saya nak tanya pasal tauhu bergedil INAMAN.') }}" target="_blank" rel="noopener" class="btn-green">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Tempah Sekarang
                    </a>
                </div>
                <dl class="mt-10 flex flex-wrap gap-6 text-sm">
                    <div>
                        <dt class="font-extrabold text-brand-brown">100%</dt>
                        <dd class="text-brand-brown/60">Homemade fresh</dd>
                    </div>
                    <div>
                        <dt class="font-extrabold text-brand-brown">{{ $featured->count() }}+</dt>
                        <dd class="text-brand-brown/60">Pakej pilihan</dd>
                    </div>
                    <div>
                        <dt class="font-extrabold text-brand-brown">Walk-in</dt>
                        <dd class="text-brand-brown/60">& tempahan majlis</dd>
                    </div>
                </dl>
            </div>

            <div class="relative animate-fade-up animate-delay-2">
                <div class="absolute -inset-3 rounded-[2rem] border-2 border-dashed border-brand-gold/50"></div>

                <div id="hero-3d" class="relative aspect-[4/3] w-full rounded-[1.75rem] overflow-hidden">
                    {{-- Fallback: hero.jpg kekal di belakang; kanvas 3D akan menimpa bila WebGL berjaya --}}
                    <img src="{{ asset('images/hero.jpg') }}" alt="Tauhu bergedil INAMAN" class="absolute inset-0 h-full w-full object-cover">
                </div>

                <div class="absolute -bottom-5 -left-3 card flex items-center gap-3 px-4 py-3 sm:-left-6">
                    <svg class="h-9 w-9 text-brand-gold-dark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                    <div>
                        <p class="text-sm font-extrabold text-brand-brown">Disukai ramai</p>
                        <p class="text-xs text-brand-brown/60">Rangup tak kering, isi padu tak melekit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MARQUEE --}}
    <div class="overflow-hidden border-y border-brand-gold/30 bg-brand-gold py-3">
        <div class="flex w-max animate-marquee gap-6 whitespace-nowrap">
            @for ($i = 0; $i < 2; $i++)
                <span class="flex gap-6 text-sm font-extrabold uppercase tracking-widest text-brand-brown-dark">
                    <span>Tauhu Bergedil Ayam</span><span class="text-white">•</span>
                    <span>Tauhu Bergedil Daging</span><span class="text-white">•</span>
                    <span>Popia Bergedil</span><span class="text-white">•</span>
                    <span>Sos Kicap Pedas</span><span class="text-white">•</span>
                    <span>Tempahan Majlis</span><span class="text-white">•</span>
                </span>
            @endfor
        </div>
    </div>

    {{-- CERITA KAMI --}}
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:py-20">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div class="relative order-2 lg:order-1">
                <img src="{{ asset('images/blog/kisah.jpg') }}" alt="Kisah INAMAN" class="aspect-[4/3] w-full rounded-3xl object-cover shadow-soft">
                <div class="absolute -top-4 -right-4 rounded-2xl bg-brand-brown px-5 py-4 text-brand-cream shadow-lift sm:-right-6">
                    <p class="text-2xl font-extrabold text-brand-gold">Sejak</p>
                    <p class="text-xs font-semibold tracking-widest text-brand-cream/70">DI DAPUR KECIL KAMI</p>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <h2 class="section-title">{{ \App\Models\SiteSetting::get('about_title', 'Kisah Kami') }}</h2>
                <p class="mt-4 text-base leading-relaxed text-brand-brown/75">
                    {{ \App\Models\SiteSetting::get('about_text') }}
                </p>
                <blockquote class="mt-6 border-l-4 border-brand-gold pl-4 text-sm italic text-brand-brown/60">
                    "Makanan yang sedap bermula dari bahan yang betul dan tangan yang sabar."
                </blockquote>
                <a href="{{ route('blog.show', 'kisah-di-sebalik-inaman') }}" class="btn-outline mt-8 text-sm">Baca Kisah Kami</a>
            </div>
        </div>
    </section>

    {{-- MENU HIGHLIGHT --}}
    <section class="bg-brand-cream-dark/60 py-16 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <span class="chip bg-brand-gold/25 text-brand-gold-dark">Favorit Ramai</span>
                    <h2 class="section-title mt-3">Menu Pilihan Kami</h2>
                </div>
                <a href="{{ route('menu.index') }}" class="btn-outline text-sm">Semua Menu</a>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($featured as $item)
                    <article class="card group overflow-hidden">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset(ltrim($item->image_path, '/')) }}" alt="{{ $item->name }}" loading="lazy" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
                            <span class="absolute left-3 top-3 chip bg-brand-gold text-brand-brown-dark">{{ $item->category->name ?? 'Menu' }}</span>
                            @if ($item->is_featured)
                                <span class="absolute right-3 top-3 chip bg-brand-brown/90 text-brand-gold">Best Seller</span>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-lg font-extrabold text-brand-brown">{{ $item->name }}</h3>
                                <p class="text-lg font-extrabold text-brand-gold-dark">{{ $item->formatted_price }}</p>
                            </div>
                            <p class="mt-1 flex items-center gap-2 text-xs font-semibold text-brand-brown/60">
                                <svg class="h-4 w-4 text-brand-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7h-1.5a2 2 0 0 1-1.7-.9L15.5 4.2A2 2 0 0 0 13.8 3.5H6a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                                {{ $item->quantity }} keping
                            </p>
                            <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-brand-brown/70">{{ $item->description }}</p>
                            <a href="https://wa.me/{{ $whatsapp }}?text={{ urlencode('Assalamualaikum, saya ingin menempah ' . $item->name . ' (' . $item->quantity . ' keping).') }}" target="_blank" rel="noopener" class="btn-green mt-4 w-full text-sm !px-4 !py-2.5">
                                Tempah via WhatsApp
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="text-brand-brown/60">Menu belum ditambah.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- TESTIMONI --}}
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:py-20">
        <div class="text-center">
            <span class="chip bg-brand-gold/25 text-brand-gold-dark">Kata Mereka</span>
            <h2 class="section-title mt-3">Yang Pelanggan Cakap</h2>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ([
                ['s', 'Aina', 'Beli pakej 10, sampai rumah masih rangup lagi. Sos kicap pedas dia pun sedap gila!'],
                ['s', 'Firdaus', 'Order untuk majlis pejabat, semua orang puji. Padat isi, tak kedekut inti.'],
                ['s', 'Kak Su', 'Anak saya dah pandai minta. Setiap minggu mesti beli tauhu bergedil INAMAN.'],
            ] as $t)
                <figure class="card p-6">
                    <div class="flex gap-0.5 text-brand-gold-dark">
                        @for ($j = 0; $j < 5; $j++)
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="mt-3 text-sm leading-relaxed text-brand-brown/75">"{{ $t[2] }}"</blockquote>
                    <figcaption class="mt-4 flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-brand-gold/20 text-sm font-extrabold text-brand-gold-dark">{{ $t[1][0] }}</span>
                        <div>
                            <p class="text-sm font-bold text-brand-brown">{{ $t[1] }}</p>
                            <p class="text-xs text-brand-brown/50">Pelanggan setia</p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>

    {{-- CARA TEMPAH --}}
    <section class="bg-brand-brown py-16 text-brand-cream lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="text-center">
                <span class="chip bg-brand-gold/20 text-brand-gold">Mudah Je</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">Cara Tempah</h2>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ([
                    ['1', 'Pilih Pakej', 'Tengok menu dan pilih pakej 6, 10 atau 20 mengikut keperluan anda.'],
                    ['2', 'WhatsApp Kami', 'Tekan butang tempah, mesej terus berhubung dengan kami. Jawab pantas!'],
                    ['3', 'Ambil & Hidang', 'Ambil terus di kedai atau order awal untuk majlis. Fresh setiap hari!'],
                ] as $step)
                    <div class="relative rounded-2xl border border-white/10 bg-white/5 p-6">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-brand-gold text-lg font-extrabold text-brand-brown-dark">{{ $step[0] }}</span>
                        <h3 class="mt-4 text-lg font-extrabold text-brand-gold">{{ $step[1] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-brand-cream/70">{{ $step[2] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn bg-brand-gold px-8 py-3.5 text-brand-brown-dark hover:bg-brand-gold-dark hover:text-white">
                    Mula Tempah Sekarang
                </a>
            </div>
        </div>
    </section>

    {{-- LOKASI --}}
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:py-20">
        <div class="grid items-stretch gap-8 lg:grid-cols-5">
            <div class="card flex flex-col gap-4 p-6 lg:col-span-2">
                <span class="w-fit chip bg-brand-gold/25 text-brand-gold-dark">Lokasi</span>
                <h2 class="text-2xl font-extrabold tracking-tight text-brand-brown">Kunjungi Kedai Kami</h2>
                <div class="space-y-4 text-sm text-brand-brown/75">
                    <p class="flex gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ \App\Models\SiteSetting::get('address') }}
                    </p>
                    <p class="flex gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        {{ \App\Models\SiteSetting::get('phone') }}
                    </p>
                    <p class="flex gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        {{ \App\Models\SiteSetting::get('hours') }}
                    </p>
                </div>
                <a href="{{ $waHref }}" target="_blank" rel="noopener" class="btn-green mt-auto text-sm">Get Arah & Tempah</a>
            </div>
            <div class="overflow-hidden rounded-3xl shadow-soft ring-1 ring-brand-brown/10 lg:col-span-3">
                <iframe src="{{ \App\Models\SiteSetting::get('map_src') }}" class="h-full min-h-[320px] w-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi INAMAN Tauhu Bergedil" allowfullscreen></iframe>
            </div>
        </div>
    </section>
</x-site-layout>