const theme = require('./theme.json');
const tailpress = require("@jeffreyvr/tailwindcss-tailpress");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './*.php',
        './**/*.php',
        './resources/css/*.css',
        './resources/js/*.js',
        './safelist.txt'
    ],
    theme: {
        container: {
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '0rem'
            },
        },
        extend: {
            colors: {
                ...tailpress.colorMapper(tailpress.theme('settings.color.palette', theme)), // Keep TailPress colors
                redOrange: '#D93B00', // Main red-orange for highlights
                lightWhite: '#FCFCFC', // Light white background
                darkGray: '#281E1B', // Dark gray for primary text
                mutedGray: '#6E5349', // Muted gray for secondary elements
            },
            fontFamily: {
                sen: ['Sen', 'sans-serif'], // For headings
                outfit: ['Outfit', 'sans-serif'], // For navigation
                domine: ['Domine', 'serif'], // For hero titles
            },
            borderRadius: {
                lg: '8px', // Rounded images and cards
            },
            fontSize: {
                ...tailpress.fontSizeMapper(tailpress.theme('settings.typography.fontSizes', theme)) // Keep TailPress font sizes
            }
        },
        screens: {
            'xs': '480px',
            'sm': '600px',
            'md': '782px',
            'lg': tailpress.theme('settings.layout.contentSize', theme),
            'xl': tailpress.theme('settings.layout.wideSize', theme),
            '2xl': '1440px'
        }
    },
    plugins: [
        tailpress.tailwind
    ]
};
