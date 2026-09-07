<x-site-layout :title="$post->title">
    <article class="mx-auto max-w-5xl px-4 py-12 sm:px-6">
        <div class="max-w-3xl">
            <nav class="text-sm text-brand-brown/50">
                <a href="{{ route('home') }}" class="hover:text-brand-gold-dark">Utama</a>
                <span class="mx-2">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-brand-gold-dark">Resepi & Kisah</a>
            </nav>
            <h1 class="mt-4 text-3xl font-extrabold leading-tight tracking-tight text-brand-brown sm:text-4xl">{{ $post->title }}</h1>
            <div class="mt-4 flex items-center gap-2 text-sm font-semibold text-brand-brown/50">
                @if ($post->category)
                    <span class="chip bg-brand-gold/25 text-brand-gold-dark">{{ $post->category->name }}</span>
                @endif
                <span>•</span>
                <span>{{ $post->published_at->format('d M Y') }}</span>
            </div>
        </div>

        <div class="mt-8 overflow-hidden rounded-3xl shadow-lift">
            <img src="{{ asset(ltrim($post->image_path, '/')) }}" alt="{{ $post->title }}" class="aspect-[16/9] w-full object-cover">
        </div>

        <div class="mt-8 grid gap-10 lg:grid-cols-3">
            <div class="article-content max-w-none lg:col-span-2">
                {!! $post->content !!}
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                @if ($recent->isNotEmpty())
                    <div class="card p-5">
                        <h3 class="text-sm font-extrabold uppercase tracking-widest text-brand-gold-dark">Artikel Lain</h3>
                        <div class="mt-4 space-y-4">
                            @foreach ($recent as $r)
                                <a href="{{ route('blog.show', $r) }}" class="group flex gap-3">
                                    <img src="{{ asset(ltrim($r->image_path, '/')) }}" alt="" loading="lazy" class="h-16 w-16 shrink-0 rounded-xl object-cover">
                                    <div>
                                        <p class="text-sm font-bold leading-snug text-brand-brown group-hover:text-brand-gold-dark">{{ $r->title }}</p>
                                        <p class="mt-1 text-xs text-brand-brown/50">{{ $r->published_at->format('d M Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="rounded-2xl bg-brand-brown p-6 text-brand-cream">
                    <h3 class="text-lg font-extrabold text-brand-gold">Nak rasa terus?</h3>
                    <p class="mt-2 text-sm leading-relaxed text-brand-cream/75">Tempah pakej tauhu bergedil INAMAN sekarang — rangup, padat isi, sampai rumah masih garing.</p>
                    <a href="{{ route('menu.index') }}" class="btn bg-brand-gold mt-5 w-full text-sm !px-4 !py-2.5 text-brand-brown-dark hover:bg-brand-gold-dark hover:text-white">
                        Lihat Menu
                    </a>
                </div>
            </aside>
        </div>
    </article>
</x-site-layout>