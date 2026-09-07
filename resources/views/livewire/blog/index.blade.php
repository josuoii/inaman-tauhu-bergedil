<div>
    @if ($categories->isNotEmpty())
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
    @endif

    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="card group overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset(ltrim($post->image_path, '/')) }}" alt="{{ $post->title }}" loading="lazy" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105">
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 text-xs font-semibold text-brand-brown/50">
                        @if ($post->category)
                            <span class="chip bg-brand-gold/25 text-brand-gold-dark">{{ $post->category->name }}</span>
                        @endif
                        <span>{{ $post->published_at->format('d M Y') }}</span>
                    </div>
                    <h2 class="mt-3 text-lg font-extrabold leading-snug text-brand-brown group-hover:text-brand-gold-dark">{{ $post->title }}</h2>
                    <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-brand-brown/70">{{ $post->excerpt }}</p>
                    <span class="mt-4 inline-flex items-center gap-1 text-sm font-bold text-brand-gold-dark">
                        Baca Lagi
                        <svg class="h-4 w-4 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-full py-16 text-center">
                <p class="text-lg font-semibold text-brand-brown/60">Belum ada artikel lagi.</p>
            </div>
        @endforelse
    </div>

    @if ($posts->hasPages())
        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    @endif
</div>