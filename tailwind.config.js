import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans], // Font bawaan Laravel sudah bagus
            },
            colors: {
                primary: {
                    DEFAULT: '#991B1B', // Red-800 (Maroon Jantung)
                    light: '#B91C1C',   // Red-700
                    dark: '#7F1D1D',    // Red-900
                },
                accent: {
                    light: '#FFE4E6',   // Rose-100 (Background lembut)
                    DEFAULT: '#F43F5E', // Rose-500 (Tombol/Ikon)
                }
            },
            boxShadow: {
                'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
            }
        },
    },
    plugins: [],
};