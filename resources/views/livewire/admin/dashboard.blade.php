<div>
    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-brand-brown">Dashboard</h1>
            <p class="mt-1 text-sm text-brand-brown/60">Ringkasan laman INAMAN tauhu bergedil.</p>
        </div>
        <a href="{{ route('admin.menu') }}" class="btn-green text-sm">Urus Menu</a>
    </header>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($stats as $s)
            <div class="card p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-brand-brown/60">{{ $s['label'] }}</p>
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-brand-gold/20 text-brand-gold-dark">
                        @if ($s['icon'] === 'menu')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                        @elseif ($s['icon'] === 'check')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        @elseif ($s['icon'] === 'cat')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.5 13 17 22l-5-3-5 3 1.5-9"/></svg>
                        @else
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        @endif
                    </span>
                </div>
                <p class="mt-3 text-3xl font-extrabold text-brand-brown">{{ $s['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="card mt-6 p-6">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-extrabold text-brand-brown">Menu Terkini</h2>
            <a href="{{ route('admin.menu') }}" class="text-sm font-bold text-brand-gold-dark hover:underline">Urus Semua →</a>
        </div>
        <div class="mt-4 divide-y divide-brand-brown/5">
            @forelse ($recentMenu as $item)
                <div class="flex items-center gap-4 py-3">
                    <img src="{{ asset(ltrim($item->image_path, '/')) }}" alt="" class="h-12 w-12 rounded-xl object-cover">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-brand-brown">{{ $item->name }}</p>
                        <p class="text-xs text-brand-brown/50">{{ $item->category->name ?? 'Tanpa kategori' }} • {{ $item->quantity }} keping</p>
                    </div>
                    <span class="chip {{ $item->is_available ? 'bg-brand-green/10 text-brand-green-dark' : 'bg-brand-brown/10 text-brand-brown/60' }}">
                        {{ $item->is_available ? 'Tersedia' : 'Habis' }}
                    </span>
                    <p class="text-sm font-extrabold text-brand-gold-dark">{{ $item->formatted_price }}</p>
                </div>
            @empty
                <p class="py-6 text-sm text-brand-brown/50">Tiada menu lagi.</p>
            @endforelse
        </div>
    </div>
</div>