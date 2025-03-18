import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {

                // Se você quiser "substituir" o indigo padrão por outro tom, pode fazer assim:
                indigo: {
                    50:  '#fffbf7',
                    100: '#fef3e7',
                    200: '#fce0c3',
                    300: '#facd9f',
                    400: '#f8a653',
                    500: '#f47a06', // <-- cor principal
                    600: '#dd6e05',
                    700: '#9a4c03',
                    800: '#763902',
                    900: '#522601',
                },
            },
        },

        plugins: [forms, typography],
    }
};
