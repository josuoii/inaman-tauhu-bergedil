<x-site-layout :title="__('Hubungi Kami - INAMAN Tauhu Bergedil')">
    @php
        $whatsapp = \App\Models\SiteSetting::get('whatsapp', '601131441795');
        $waHref = "https://wa.me/{$whatsapp}";
    @endphp

    <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
        <div class="text-center">
            <span class="chip bg-brand-gold/25 text-brand-gold-dark">Hubungi</span>
            <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-brand-brown sm:text-5xl">Jom Borak & Tempah</h1>
            <p class="mx-auto mt-4 max-w-xl text-brand-brown/70">
                Ada sebarang soalan, nak tempah majlis, atau cuma nak cakap "sedap!" — kami sedia menjawab.
            </p>
        </div>

        <div class="mt-12 grid gap-8 lg:grid-cols-2">
            <div class="space-y-5">
                <a href="{{ $waHref }}" target="_blank" rel="noopener" class="card group flex items-center gap-4 p-6 transition hover:shadow-lift">
                    <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-brand-green text-white">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </span>
                    <div>
                        <p class="text-lg font-extrabold text-brand-brown group-hover:text-brand-gold-dark">Tempah WhatsApp</p>
                        <p class="text-sm text-brand-brown/60">Respon pantas waktu operasi. Tekan untuk terus chat.</p>
                    </div>
                    <svg class="ml-auto h-5 w-5 text-brand-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>

                <div class="card flex items-center gap-4 p-6">
                    <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-brand-gold/20 text-brand-gold-dark">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div>
                        <p class="text-lg font-extrabold text-brand-brown">Alamat Kedai</p>
                        <p class="text-sm text-brand-brown/60">{{ \App\Models\SiteSetting::get('address') }}</p>
                    </div>
                </div>

                <div class="card flex items-center gap-4 p-6">
                    <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-brand-gold/20 text-brand-gold-dark">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </span>
                    <div>
                        <p class="text-lg font-extrabold text-brand-brown">Telefon</p>
                        <p class="text-sm text-brand-brown/60"><a href="tel:{{ preg_replace('/\D/', '', \App\Models\SiteSetting::get('phone')) }}" class="hover:text-brand-gold-dark">{{ \App\Models\SiteSetting::get('phone') }}</a></p>
                    </div>
                </div>

                <div class="card flex items-center gap-4 p-6">
                    <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-brand-gold/20 text-brand-gold-dark">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </span>
                    <div>
                        <p class="text-lg font-extrabold text-brand-brown">Waktu Operasi</p>
                        <p class="text-sm text-brand-brown/60">{{ \App\Models\SiteSetting::get('hours') }}</p>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl shadow-soft ring-1 ring-brand-brown/10">
                <iframe src="{{ \App\Models\SiteSetting::get('map_src') }}" class="h-full min-h-[420px] w-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi INAMAN Tauhu Bergedil" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</x-site-layout>