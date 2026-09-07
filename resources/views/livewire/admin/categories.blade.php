<div>
    <header>
        <h1 class="text-2xl font-extrabold tracking-tight text-brand-brown">Kategori</h1>
        <p class="mt-1 text-sm text-brand-brown/60">Susun kategori menu dan blog.</p>
    </header>

    <div class="card mt-6 p-6">
        <h2 class="text-sm font-extrabold uppercase tracking-widest text-brand-gold-dark">Tambah Kategori</h2>
        <form wire:submit="create" class="mt-4 grid gap-4 sm:grid-cols-4">
            <div class="sm:col-span-2">
                <input type="text" wire:model="name" placeholder="Nama kategori (cth: Tauhu Bergedil Ayam)" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <select wire:model="type" class="rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                <option value="menu">Menu</option>
                <option value="blog">Blog</option>
            </select>
            <button type="submit" class="btn-green text-sm">Tambah</button>
        </form>

        <div class="mt-6 divide-y divide-brand-brown/5">
            @forelse ($categories as $cat)
                <div class="flex flex-wrap items-center gap-3 py-3">
                    @if ($editingId === $cat->id)
                        <input type="text" wire:model="name" class="w-64 rounded-xl border-brand-brown/15 text-sm focus:border-brand-gold focus:ring-brand-gold">
                        <select wire:model="type" class="rounded-xl border-brand-brown/15 text-sm">
                            <option value="menu">Menu</option>
                            <option value="blog">Blog</option>
                        </select>
                        <input type="number" wire:model="sortOrder" class="w-24 rounded-xl border-brand-brown/15 text-sm" title="Susunan">
                        <button type="button" wire:click="saveEdit" class="btn-green px-4 py-1.5 text-xs">Simpan</button>
                        <button type="button" wire:click="cancelEdit" class="btn-outline px-4 py-1.5 text-xs">Batal</button>
                    @else
                        <span class="grid h-9 w-9 place-items-center rounded-xl bg-brand-gold/20 text-sm font-extrabold text-brand-gold-dark">{{ $cat->name[0] }}</span>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-brand-brown">{{ $cat->name }}</p>
                            <p class="text-xs text-brand-brown/50">{{ $cat->menuItems_count ?? '' }}<span class="ml-1 uppercase tracking-wide text-brand-brown/40">{{ $cat->type }}</span> • urutan {{ $cat->sort_order }}</p>
                        </div>
                        <span class="chip {{ $cat->type === 'menu' ? 'bg-brand-gold/20 text-brand-gold-dark' : 'bg-brand-green/10 text-brand-green-dark' }}">{{ $cat->type === 'menu' ? 'Menu' : 'Blog' }}</span>
                        <button type="button" wire:click="edit({{ $cat->id }})" class="rounded-lg px-3 py-1.5 text-xs font-bold text-brand-gold-dark hover:bg-brand-gold/15">Edit</button>
                        <button type="button" wire:click="delete({{ $cat->id }})" wire:confirm="Padam kategori '{{ $cat->name }}'? Item terkait akan dinyahpaut (null)." class="rounded-lg px-3 py-1.5 text-xs font-bold text-red-700 hover:bg-red-50">Padam</button>
                    @endif
                </div>
            @empty
                <p class="py-6 text-sm text-brand-brown/50">Tiada kategori lagi.</p>
            @endforelse
        </div>
    </div>
</div>