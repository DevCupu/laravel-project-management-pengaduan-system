import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                "on-tertiary-fixed-variant": "#773200",
                "secondary": "#505f76",
                "surface-dim": "#d8dadc",
                "surface-variant": "#e0e3e5",
                "outline": "#727782",
                "on-primary-container": "#a5c7ff",
                "surface-container-low": "#f2f4f6",
                "inverse-primary": "#a7c8ff",
                "on-surface": "#191c1e",
                "surface-container": "#eceef0",
                "on-primary": "#ffffff",
                "background": "#f7f9fb",
                "inverse-on-surface": "#eff1f3",
                "surface-bright": "#f7f9fb",
                "on-secondary-fixed-variant": "#38485d",
                "tertiary-fixed-dim": "#ffb68f",
                "on-secondary-fixed": "#0b1c30",
                "on-tertiary-container": "#ffb58e",
                "on-tertiary": "#ffffff",
                "surface": "#f7f9fb",
                "secondary-fixed-dim": "#b7c8e1",
                "on-secondary": "#ffffff",
                "secondary-fixed": "#d3e4fe",
                "on-error-container": "#93000a",
                "on-background": "#191c1e",
                "surface-tint": "#1d5fa9",
                "on-error": "#ffffff",
                "on-surface-variant": "#424751",
                "tertiary-container": "#893b01",
                "on-tertiary-fixed": "#331100",
                "secondary-container": "#d0e1fb",
                "tertiary-fixed": "#ffdbca",
                "inverse-surface": "#2d3133",
                "error-container": "#ffdad6",
                "primary-fixed": "#d5e3ff",
                "on-primary-fixed-variant": "#004788",
                "on-secondary-container": "#54647a",
                "surface-container-highest": "#e0e3e5",
                "surface-container-lowest": "#ffffff",
                "on-primary-fixed": "#001b3b",
                "error": "#ba1a1a",
                "primary": "#003b73",
                "surface-container-high": "#e6e8ea",
                "outline-variant": "#c2c6d3",
                "primary-fixed-dim": "#a7c8ff",
                "primary-container": "#00529c",
                "tertiary": "#652900"
            },
            borderRadius: {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                headline: ["Public Sans"],
                body: ["Inter"],
                label: ["Inter"]
            },
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/container-queries')
    ],
};
