<div>
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-brand-brown">Menu Pakej</h1>
            <p class="mt-1 text-sm text-brand-brown/60">Tambah, ubah harga & kuantiti, kawal stok dan highlight pakej.</p>
        </div>
        <button type="button" wire:click="create" class="btn-green text-sm">+ Menu Baharu</button>
    </header>

    <div class="card mt-6 p-5">
        <div class="flex flex-wrap items-center gap-3">
            <input type="search" wire:model.live.debounce.300ms="search" placeholder="Cari pakej..." class="w-full max-w-xs rounded-xl border-brand-brown/15 text-sm focus:border-brand-gold focus:ring-brand-gold">
            <select wire:model.live="filterCategory" class="rounded-xl border-brand-brown/15 text-sm focus:border-brand-gold focus:ring-brand-gold">
                <option value="0">Semua kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-brand-brown/10 text-xs font-bold uppercase tracking-wider text-brand-brown/50">
                        <th class="py-3 pr-4">Pakej</th>
                        <th class="py-3 pr-4">Kategori</th>
                        <th class="py-3 pr-4">Kuantiti</th>
                        <th class="py-3 pr-4">Harga</th>
                        <th class="py-3 pr-4">Stok</th>
                        <th class="py-3 pr-4">Best</th>
                        <th class="py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-brown/5">
                    @forelse ($items as $item)
                        <tr class="hover:bg-brand-cream/50">
                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset(ltrim($item->image_path, '/')) }}" alt="" class="h-11 w-11 rounded-lg object-cover">
                                    <div>
                                        <p class="font-bold text-brand-brown">{{ $item->name }}</p>
                                        <p class="text-xs text-brand-brown/45">{{ $item->description }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 pr-4 text-brand-brown/70">{{ $item->category->name ?? '-' }}</td>
                            <td class="py-3 pr-4 text-brand-brown/70">{{ $item->quantity }} kpg</td>
                            <td class="py-3 pr-4 font-extrabold text-brand-gold-dark">{{ $item->formatted_price }}</td>
                            <td class="py-3 pr-4">
                                <button type="button" wire:click="toggleAvailable({{ $item->id }})" class="{{ $item->is_available ? 'bg-brand-green/10 text-brand-green-dark' : 'bg-brand-brown/10 text-brand-brown/60' }} rounded-full px-3 py-1 text-xs font-bold">
                                    {{ $item->is_available ? 'Tersedia' : 'Habis' }}
                                </button>
                            </td>
                            <td class="py-3 pr-4">
                                <button type="button" wire:click="toggleFeatured({{ $item->id }})" class="{{ $item->is_featured ? 'bg-brand-gold text-brand-brown-dark' : 'bg-brand-brown/10 text-brand-brown/60' }} rounded-full px-3 py-1 text-xs font-bold">
                                    {{ $item->is_featured ? 'Best Seller' : 'Biasa' }}
                                </button>
                            </td>
                            <td class="py-3 text-right">
                                <button type="button" wire:click="edit({{ $item->id }})" class="rounded-lg px-3 py-1.5 text-xs font-bold text-brand-gold-dark hover:bg-brand-gold/15">Edit</button>
                                <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Padam '{{ $item->name }}'? Tindakan ini tidak boleh dibatalkan." class="rounded-lg px-3 py-1.5 text-xs font-bold text-red-700 hover:bg-red-50">Padam</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-10 text-center text-sm text-brand-brown/50">Tiada menu. Tekan '+ Menu Baharu' untuk mula.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($showForm)
        <div class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-brand-brown/50 p-6 backdrop-blur-sm" wire:click.self="$set('showForm', false)">
            <form wire:submit="save" class="card w-full max-w-2xl p-6 sm:p-8">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-extrabold text-brand-brown">{{ $editingId ? 'Edit' : 'Menu Baharu' }}</h2>
                        <p class="mt-1 text-sm text-brand-brown/60">Field dengan <span class="text-red-600">*</span> wajib diisi.</p>
                    </div>
                    <button type="button" wire:click="$set('showForm', false)" class="rounded-lg p-2 text-brand-brown/50 hover:bg-brand-brown/5">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Nama Pakej <span class="text-red-600">*</span></label>
                        <input type="text" wire:model="name" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Kategori <span class="text-red-600">*</span></label>
                        <select wire:model="categoryId" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('categoryId') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Kuantiti (keping) <span class="text-red-600">*</span></label>
                        <input type="number" wire:model="quantity" min="1" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                        @error('quantity') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Harga (RM) <span class="text-red-600">*</span></label>
                        <input type="number" step="0.01" min="0" wire:model="price" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                        @error('price') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Susunan</label>
                        <input type="number" wire:model="sortOrder" min="0" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Imej URL / Path</label>
                        <input type="text" wire:model="imagePath" placeholder="/images/menu/ayam-6.jpg" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-bold text-brand-brown">Penerangan</label>
                        <textarea wire:model="description" rows="3" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold"></textarea>
                    </div>
                    <label class="flex items-center gap-2 text-sm font-semibold text-brand-brown">
                        <input type="checkbox" wire:model="isAvailable" class="rounded border-brand-brown/25 text-brand-gold-dark focus:ring-brand-gold">
                        Tersedia untuk tempahan
                    </label>
                    <label class="flex items-center gap-2 text-sm font-semibold text-brand-brown">
                        <input type="checkbox" wire:model="isFeatured" class="rounded border-brand-brown/25 text-brand-gold-dark focus:ring-brand-gold">
                        Tandakan sebagai Best Seller
                    </label>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" wire:click="$set('showForm', false)" class="btn-outline text-sm">Batal</button>
                    <button type="submit" class="btn-green text-sm">Simpan Menu</button>
                </div>
            </form>
        </div>
    @endif

    <div x-data="{ show: false, msg: '' }" x-on:menu-saved.window="msg = $event.detail.message; show = true; setTimeout(() => show = false, 2500)" x-cloak>
        <template x-if="show">
            <div class="fixed bottom-6 right-6 z-50 card bg-brand-green px-5 py-3 text-sm font-bold text-white">
                <span x-text="msg"></span>
            </div>
        </template>
    </div>
</div>