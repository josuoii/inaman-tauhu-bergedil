<div>
    <header>
        <h1 class="text-2xl font-extrabold tracking-tight text-brand-brown">Tetapan Laman</h1>
        <p class="mt-1 text-sm text-brand-brown/60">Maklumat kedai, hubungan dan peta. Perubahan serta-merta pada laman awam.</p>
    </header>

    <form wire:submit="save" class="card mt-6 p-6 sm:p-8">
        <h2 class="text-sm font-extrabold uppercase tracking-widest text-brand-gold-dark">Identiti & Jenama</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">Nama Jenama <span class="text-red-600">*</span></label>
                <input type="text" wire:model="brandName" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">Tagline</label>
                <input type="text" wire:model="tagline" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div class="sm:col-span-2">
                <label class="mb-1 block text-sm font-bold text-brand-brown">Tajuk Bahagian Kisah</label>
                <input type="text" wire:model="aboutTitle" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div class="sm:col-span-2">
                <label class="mb-1 block text-sm font-bold text-brand-brown">Teks Kisah (bahagian 'Kisah Kami')</label>
                <textarea wire:model="aboutText" rows="4" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold"></textarea>
            </div>
        </div>

        <hr class="my-6 border-brand-brown/10">

        <h2 class="text-sm font-extrabold uppercase tracking-widest text-brand-gold-dark">Hubungan & Operasi</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="mb-1 block text-sm font-bold text-brand-brown">Alamat</label>
                <input type="text" wire:model="address" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">Telefon (paparan)</label>
                <input type="text" wire:model="phone" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">WhatsApp (format: 601131441795)</label>
                <input type="text" wire:model="whatsapp" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div class="sm:col-span-2">
                <label class="mb-1 block text-sm font-bold text-brand-brown">Waktu Operasi</label>
                <input type="text" wire:model="hours" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">Facebook URL</label>
                <input type="text" wire:model="facebook" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">Instagram URL</label>
                <input type="text" wire:model="instagram" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">TikTok URL</label>
                <input type="text" wire:model="tiktok" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
            <div>
                <label class="mb-1 block text-sm font-bold text-brand-brown">Embed Peta (iframe src)</label>
                <input type="text" wire:model="mapSrc" class="w-full rounded-xl border-brand-brown/15 focus:border-brand-gold focus:ring-brand-gold">
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="btn-green text-sm">Simpan Tetapan</button>
        </div>
    </form>
</div>