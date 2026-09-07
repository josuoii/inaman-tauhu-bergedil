<div id="il-preloader" class="il-preloader" aria-hidden="true" role="status" aria-label="Memuatkan...">

    {{-- Grain overlay is handled in CSS via ::before --}}

    <div class="relative flex flex-col items-center gap-7 px-6 text-center">

        {{-- SVG wordmark draw animation --}}
        <svg viewBox="0 0 340 78" class="w-56 text-brand-gold sm:w-72" role="img" aria-label="INAMAN">
            <title>INAMAN</title>
            <g stroke="currentColor" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round" fill="none">
                {{-- I --}}
                <path class="il-letter" style="--ld:.02s"  pathLength="1" d="M40 10 V62"/>
                <path class="il-letter" style="--ld:.09s"  pathLength="1" d="M32 18 H48"/>
                <path class="il-letter" style="--ld:.16s"  pathLength="1" d="M32 54 H48"/>
                {{-- N --}}
                <path class="il-letter" style="--ld:.20s"  pathLength="1" d="M79 10 V62"/>
                <path class="il-letter" style="--ld:.27s"  pathLength="1" d="M79 10 L105 62"/>
                <path class="il-letter" style="--ld:.34s"  pathLength="1" d="M105 10 V62"/>
                {{-- A --}}
                <path class="il-letter" style="--ld:.38s"  pathLength="1" d="M131 62 L144 10"/>
                <path class="il-letter" style="--ld:.45s"  pathLength="1" d="M157 62 L144 10"/>
                <path class="il-letter" style="--ld:.52s"  pathLength="1" d="M135 42 H153"/>
                {{-- M --}}
                <path class="il-letter" style="--ld:.56s"  pathLength="1" d="M183 10 V62"/>
                <path class="il-letter" style="--ld:.63s"  pathLength="1" d="M183 10 L196 42"/>
                <path class="il-letter" style="--ld:.70s"  pathLength="1" d="M209 10 L196 42"/>
                <path class="il-letter" style="--ld:.77s"  pathLength="1" d="M209 10 V62"/>
                {{-- A --}}
                <path class="il-letter" style="--ld:.81s"  pathLength="1" d="M235 62 L248 10"/>
                <path class="il-letter" style="--ld:.88s"  pathLength="1" d="M261 62 L248 10"/>
                <path class="il-letter" style="--ld:.95s"  pathLength="1" d="M239 42 H257"/>
                {{-- N --}}
                <path class="il-letter" style="--ld:1.00s" pathLength="1" d="M287 10 V62"/>
                <path class="il-letter" style="--ld:1.07s" pathLength="1" d="M287 10 L313 62"/>
                <path class="il-letter" style="--ld:1.14s" pathLength="1" d="M313 10 V62"/>
            </g>
        </svg>

        {{-- Tagline --}}
        <p class="il-tagline text-[0.62rem] font-bold uppercase tracking-[0.55em] text-brand-gold-dark">
            Tauhu Bergedil &middot; Buatan Tangan
        </p>

        {{-- Progress bar --}}
        <div class="il-bar-wrap h-[3px] w-36 overflow-hidden rounded-full bg-brand-parchment/60">
            <div class="il-bar h-full w-full origin-left rounded-full"
                 style="background: linear-gradient(90deg, #EDD38A, #C9973A, #A07828);">
            </div>
        </div>
    </div>
</div>