<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Admin' }} — {{ config('app.name', 'INAMAN') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus+jakarta+sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f4f1ea] font-sans antialiased text-brand-brown min-h-screen">
        <div class="flex">
            <aside class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col bg-brand-brown text-brand-cream/80">
                <div class="flex items-center gap-3 px-6 py-5">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-brand-gold to-brand-gold-dark text-brand-brown-dark">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" aria-hidden="true"><path d="M7 7h10M7 12h10M12 7v10" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/></svg>
                    </span>
                    <div class="leading-tight">
                        <p class="text-sm font-extrabold text-brand-cream">INAMAN</p>
                        <p class="text-[0.6rem] font-bold uppercase tracking-widest text-brand-gold">Admin Panel</p>
                    </div>
                </div>
                <nav class="mt-2 flex-1 space-y-1 overflow-y-auto px-3 text-sm font-semibold">
                    @php
                        $adminNav = [
                            ['admin.dashboard', 'Dashboard', '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/>'],
                            ['admin.menu', 'Menu Pakej', '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>'],
                            ['admin.categories', 'Kategori', '<circle cx="12" cy="8" r="6"/><path d="M15.5 13 17 22l-5-3-5 3 1.5-9"/>'],
                            ['admin.blog', 'Resepi & Kisah', '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>'],
                            ['admin.settings', 'Tetapan', '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>'],
                        ];
                        $current = request()->route()?->getName();
                    @endphp
                    @foreach ($adminNav as [$routeName, $label, $icon])
                        <a href="{{ route($routeName) }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition {{ $current === $routeName ? 'bg-brand-gold text-brand-brown-dark' : 'hover:bg-white/10' }}">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icon !!}</svg>
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
                <div class="border-t border-white/10 p-4">
                    <a href="{{ route('home') }}" target="_blank" class="mb-2 flex items-center gap-3 rounded-lg px-3 py-2 text-sm hover:bg-white/10">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg>
                        Lihat Laman
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-brand-cream/70 hover:bg-white/10 hover:text-brand-cream">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5M21 12H9"/></svg>
                            Log Keluar
                        </button>
                    </form>
                </div>
            </aside>

            <main class="ml-64 flex-1">
                <div class="max-w-5xl px-8 py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>