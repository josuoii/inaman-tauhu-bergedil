@props(['onDark' => false])
@php
    $brand = \App\Models\SiteSetting::get('brand_name', 'INAMAN Tauhu Bergedil');
@endphp
<a href="{{ route('home') }}" class="group inline-flex max-w-[220px] items-center">
    @if ($onDark)
        <span class="rounded-xl bg-brand-cream/95 p-1.5 transition-transform group-hover:-rotate-3">
            <img src="{{ asset('images/logo-inaman.png') }}" alt="{{ $brand }}" class="h-9 w-auto sm:h-10">
        </span>
    @else
        <img src="{{ asset('images/logo-inaman.png') }}" alt="{{ $brand }}" class="h-11 w-auto transition-transform group-hover:-rotate-3 sm:h-12">
    @endif
    <span class="sr-only">{{ $brand }}</span>
</a>