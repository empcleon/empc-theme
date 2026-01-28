import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./src/**/*.{js,ts,jsx,tsx}",
        "./**/*.php"
    ],
    theme: {
        extend: {
            colors: {
                'slate-deep': '#121826',
                'dusty-rose': '#E29595',
                'soft-pink': '#FCE7F3',
                primary: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                },
                brand: colors.emerald,
                slate: colors.slate,
                soberana: {
                    bg: 'var(--color-background)',
                    primary: 'var(--color-primary)',
                    secondary: 'var(--color-secondary)',
                    text: 'var(--color-text)',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                soberana: ['var(--font-heading)', 'sans-serif'],
                inter: ['var(--font-body)', 'sans-serif'],
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
