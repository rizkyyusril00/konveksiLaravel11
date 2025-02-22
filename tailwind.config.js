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
                    "primary": "#F8FAFC",
                    "secondary": "#F8FAFC",
                    "accent": "#222222",
                    "neutral": "#9AA6B2",
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
