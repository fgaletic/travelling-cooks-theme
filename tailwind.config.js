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
                mutedPink: '#d39e8a', // Soft muted pink
                darkBrown: '#44312b', // Dark brown for text
                slateGray: '#73868c', // Slate gray for details
                offWhite: '#f4f3ed', // Off-white for backgrounds
            },
            fontFamily: {
                recoleta: ['Recoleta', 'serif'], // For titles
                dmsans: ['DM Sans', 'sans-serif'], // For body text
                buffalo: ['Buffalo', 'sans-serif'], // For decorative text
            },
            borderRadius: {
                lg: '8px', // Keep rounded styling
            },
            fontSize: {
                ...tailpress.fontSizeMapper(tailpress.theme('settings.typography.fontSizes', theme)) // Keep TailPress font sizes
            }
        },
        screens: {
            'xs': '480px',
            'sm': '600px',
            'md': '700px',
            'lg': tailpress.theme('settings.layout.contentSize', theme),
            'xl': tailpress.theme('settings.layout.wideSize', theme),
            '2xl': '1440px'
        }
    },
    plugins: [
        tailpress.tailwind
    ]
};
