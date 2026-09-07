<div>
    <div class="mt-8 flex flex-wrap justify-center gap-2">
        <button type="button" wire:click="setCategory(null)" class="rounded-full px-5 py-2 text-sm font-bold transition {{ is_null($categoryId) ? 'bg-brand-brown text-brand-gold' : 'bg-white text-brand-brown ring-1 ring-brand-brown/15 hover:bg-brand-gold/15' }}">
            Semua
        </button>
        @foreach ($categories as $cat)
            <button type="button" wire:click="setCategory({{ $cat->id }})" class="rounded-full px-5 py-2 text-sm font-bold transition {{ $categoryId === $cat->id ? 'bg-brand-brown text-brand-gold' : 'bg-white text-brand-brown ring-1 ring-brand-brown/15 hover:bg-brand-gold/15' }}">
                {{ $cat->name }}
            </button>
        @endforeach
    </div>

    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($items as $item)
            <article class="card group overflow-hidden">
                <div class="relative overflow-hidden">
                    <img src="{{ asset(ltrim($item->image_path, '/')) }}" alt="{{ $item->name }}" loading="lazy" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
                    <span class="absolute left-3 top-3 chip bg-brand-gold text-brand-brown-dark">{{ $item->category->name ?? 'Menu' }}</span>
                    @if (!$item->is_available)
                        <span class="absolute inset-0 grid place-items-center bg-brand-brown/60 backdrop-blur-sm">
                            <span class="chip bg-brand-brown text-brand-cream">Habis buat masa ini</span>
                        </span>
                    @endif
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between gap-3">
                        <h2 class="text-lg font-extrabold text-brand-brown">{{ $item->name }}</h2>
                        <p class="text-lg font-extrabold text-brand-gold-dark">{{ $item->formatted_price }}</p>
                    </div>
                    <p class="mt-1 flex items-center gap-2 text-xs font-semibold text-brand-brown/60">
                        <svg class="h-4 w-4 text-brand-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7h-1.5a2 2 0 0 1-1.7-.9L15.5 4.2A2 2 0 0 0 13.8 3.5H6a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                        {{ $item->quantity }} keping
                    </p>
                    <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-brand-brown/70">{{ $item->description }}</p>
                    <a href="https://wa.me/{{ \App\Models\SiteSetting::get('whatsapp', '601131441795') }}?text={{ urlencode('Assalamualaikum, saya ingin menempah ' . $item->name . ' (' . $item->quantity . ' keping).') }}" target="_blank" rel="noopener" class="btn-green mt-4 w-full text-sm !px-4 !py-2.5 {{ $item->is_available ? '' : 'pointer-events-none opacity-40' }}">
                        Tempah via WhatsApp
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-full py-16 text-center">
                <p class="text-lg font-semibold text-brand-brown/60">Tiada menu dalam kategori ini buat masa ini.</p>
                <p class="mt-2 text-sm text-brand-brown/40">Datang lagi nanti atau hubungi kami terus.</p>
            </div>
        @endforelse
    </div>
</div>