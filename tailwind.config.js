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
            },
            colors: {
                brand: {
                    gold: '#D4A843',
                    'gold-dark': '#B3892F',
                    'gold-light': '#F2DFB4',
                    brown: '#4A2C0A',
                    'brown-dark': '#381F06',
                    cream: '#FFF8E7',
                    'cream-dark': '#F3E8CF',
                    green: '#2D6A4F',
                    'green-dark': '#1F4E3A',
                },
            },
            boxShadow: {
                soft: '0 10px 30px -12px rgba(74, 44, 10, 0.18)',
                lift: '0 18px 40px -18px rgba(74, 44, 10, 0.35)',
            },
            keyframes: {
                marquee: {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                'fade-up': {
                    '0%': { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
            animation: {
                marquee: 'marquee 28s linear infinite',
                'fade-up': 'fade-up 0.6s ease-out both',
            },
        },
    },

    plugins: [forms],
};