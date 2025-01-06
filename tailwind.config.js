import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('daisyui'),
      ],
      daisyui: {
        themes: [
            {
                mytheme: {
                    "primary": "#f2f8fc",
                    "secondary": "#0a2440",
                    "accent": "#e3e8ff",
                    "neutral": "#e9e9e9",
                    "base-100": "#F8FAFC",
                    "info": "#1bbdff",
                    "success": "#00ff95",
                    "warning": "#ffd400",
                    "error": "#ff444f",
                  },
              },
        ],
      },
};
