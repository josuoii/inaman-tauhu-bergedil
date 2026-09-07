import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                serif: ['"Lora"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                brand: {
                    // Gold family — richer, more nuanced
                    gold:         '#C9973A',
                    'gold-dark':  '#A07828',
                    'gold-light': '#EDD38A',
                    'gold-pale':  '#F7EDCF',
                    // Brown family — deep & layered
                    brown:        '#3B2208',
                    'brown-dark': '#271604',
                    'brown-mid':  '#5C3413',
                    // Cream / parchment family
                    cream:        '#FBF5E6',
                    'cream-dark': '#F1E5C8',
                    parchment:    '#EFE0B8',
                    // Accent
                    ember:        '#C0481A',  // warm terracotta for urgency/highlight
                    charcoal:     '#1E1810',  // near-black warm
                    // Green for WhatsApp CTA
                    green:        '#1E6B42',
                    'green-dark': '#155230',
                    'green-light':'#D4EDE1',
                },
            },
            boxShadow: {
                // Organic, warm-toned shadows — not cold grey
                soft:    '0 8px 24px -8px rgba(59, 34, 8, 0.14)',
                lift:    '0 20px 48px -16px rgba(59, 34, 8, 0.32)',
                glow:    '0 0 0 3px rgba(201, 151, 58, 0.22)',
                'gold':  '0 4px 16px -4px rgba(201, 151, 58, 0.45)',
                'inset-top': 'inset 0 2px 0 0 rgba(255,255,255,0.12)',
            },
            backgroundImage: {
                'gold-gradient': 'linear-gradient(135deg, #EDD38A 0%, #C9973A 50%, #A07828 100%)',
                'brown-gradient':'linear-gradient(160deg, #3B2208 0%, #271604 100%)',
                'cream-gradient':'linear-gradient(180deg, #FBF5E6 0%, #F1E5C8 100%)',
                'hero-glow':     'radial-gradient(ellipse 70% 60% at 65% 40%, rgba(201,151,58,0.12) 0%, transparent 70%)',
            },
            keyframes: {
                // Marquee scroll
                marquee: {
                    '0%':   { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                // Subtle entrance fade-up
                'fade-up': {
                    '0%':   { opacity: '0', transform: 'translateY(22px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                // Reveal from clip-path
                'reveal': {
                    '0%':   { opacity: '0', clipPath: 'inset(0 100% 0 0)' },
                    '100%': { opacity: '1', clipPath: 'inset(0 0% 0 0)' },
                },
                // Number count pulse
                'count-pop': {
                    '0%':   { transform: 'scale(0.85)', opacity: '0' },
                    '60%':  { transform: 'scale(1.04)' },
                    '100%': { transform: 'scale(1)',   opacity: '1' },
                },
                // Shimmer across element
                shimmer: {
                    '0%':   { backgroundPosition: '-200% center' },
                    '100%': { backgroundPosition: '200% center' },
                },
                // Gentle float up-down
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-8px)' },
                },
                // Pulse ring for floating CTA
                'ping-ring': {
                    '0%':   { transform: 'scale(1)',    opacity: '0.8' },
                    '70%':  { transform: 'scale(1.55)', opacity: '0' },
                    '100%': { transform: 'scale(1.55)', opacity: '0' },
                },
                // Grain drift (subtle)
                'grain': {
                    '0%, 100%': { transform: 'translate(0, 0)' },
                    '10%':      { transform: 'translate(-2%, -3%)' },
                    '30%':      { transform: 'translate(2%, 1%)' },
                    '50%':      { transform: 'translate(-1%, 3%)' },
                    '70%':      { transform: 'translate(3%, -1%)' },
                    '90%':      { transform: 'translate(-2%, 2%)' },
                },
                // Underline slide-in
                'underline-in': {
                    '0%':   { transform: 'scaleX(0)', transformOrigin: 'left' },
                    '100%': { transform: 'scaleX(1)', transformOrigin: 'left' },
                },
            },
            animation: {
                marquee:      'marquee 32s linear infinite',
                'fade-up':    'fade-up 0.65s cubic-bezier(0.22,1,0.36,1) both',
                'reveal':     'reveal 0.8s cubic-bezier(0.22,1,0.36,1) both',
                'count-pop':  'count-pop 0.5s cubic-bezier(0.22,1,0.36,1) both',
                shimmer:      'shimmer 2.2s linear infinite',
                float:        'float 5s ease-in-out infinite',
                'ping-ring':  'ping-ring 2s ease-out infinite',
                grain:        'grain 7s steps(10) infinite',
            },
            transitionTimingFunction: {
                'spring': 'cubic-bezier(0.22, 1, 0.36, 1)',
            },
            letterSpacing: {
                'widest-xl': '0.2em',
            },
        },
    },

    plugins: [forms],
};