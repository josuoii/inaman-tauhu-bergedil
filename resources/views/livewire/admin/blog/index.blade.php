<div>
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-brand-brown">Resepi & Kisah</h1>
            <p class="mt-1 text-sm text-brand-brown/60">Tulis dan urus artikel blog.</p>
        </div>
        <button type="button" wire:click="create" class="btn-green text-sm">+ Artikel Baharu</button>
    </header>

    <div class="card mt-6 divide-y divide-brand-brown/5">
        @forelse ($posts as $post)
            <div class="flex flex-wrap items-center gap-4 p-5">
                <img src="{{ asset(ltrim($post->image_path, '/')) }}" alt="" class="h-16 w-16 shrink-0 rounded-xl object-cover">
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        @if ($post->category)
                            <span class="chip bg-brand-gold/20 text-brand-gold-dark">{{ $post->category->name }}</span>
                        @endif
                        <span class="text-xs text-brand-brown/50">{{ $post->published_at->format('d M Y, H:i') }}</span>
                    </div>
                    <p class="mt-1 truncate font-bold text-brand-brown">{{ $post->title }}</p>
                    <p class="truncate text-sm text-brand-brown/55">{{ $post->excerpt }}</p>
                </div>
                <div class="flex shrink-0 gap-2">
                    <button type="button" wire:click="edit({{ $post->id }})" class="rounded-lg px-3 py-1.5 text-xs font-bold text-brand-gold-dark hover:bg-brand-gold/15">Edit</button>
                    <a href="{{ route('blog.show', $post) }}" target="_blank" class="rounded-lg px-3 py-1.5 text-xs font-bold text-brand-green-dark hover:bg-brand-green/10">Lihat</a>
                    <button type="button" wire:click="delete({{ $post->id }})" wire:confirm="Padam '{{ $post->title }}'?" class="rounded-lg px-3 py-1.5 text-xs font-bold text-red-700 hover:bg-red-50">Padam</button>
                </div>
            </div>
        @empty
            <p class="p-8 text-center text-sm text-brand-brown/50">Tiada artikel lagi. Tekan '+ Artikel Baharu'.</p>
        @endforelse
    </div>

    @if ($showForm)
        <div class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-brand-brown/50 p-6 backdrop-blur-sm" wire:click.self="$set('showForm', false)">
            <form wire:submit="save" class="card w-full max-w-3xl p-6 sm:p-8">
                <div class="flex items-start justify-between">
                    <h2 class="text-xl font-extrabold text-brand-brown">{{ $editingId ? 'Edit' : 'Artikel Baharu' }}</h2>
                    <button type="button" wire:click="$set('showForm', false)" class="rounded-lg p-2 text-brand-brown/50 hover:bg-brand-brown/5">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Tajuk <span class="text-red-600">*</span></label>
                        <input type="text" wire:model="title" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                        @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Kategori</label>
                        <select wire:model="categoryId" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Terbit Pada</label>
                        <input type="datetime-local" wire:model="publishedAt" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Ringkasan (excerpt)</label>
                        <input type="text" wire:model="excerpt" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Imej URL / Path</label>
                        <input type="text" wire:model="imagePath" placeholder="/images/blog/resepi.jpg" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Kandungan (HTML) <span class="text-red-600">*</span></label>
                        <textarea wire:model="content" rows="10" class="w-full rounded-xl border-brand-brown/15 font-mono text-sm focus:border-brand-gold focus:ring-brand-gold"></textarea>
                        <p class="mt-1 text-xs text-brand-brown/50">Sokong &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;strong&gt;, &lt;img src="..."&gt;.</p>
                        @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" wire:click="$set('showForm', false)" class="btn-outline text-sm">Batal</button>
                    <button type="submit" class="btn-green text-sm">Simpan Artikel</button>
                </div>
            </form>
        </div>
    @endif
</div>