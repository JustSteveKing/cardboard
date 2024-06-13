/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    plugins: [
    ],
    theme: {
        extend: {
            colors: {
                primary: "#fc5203",
                secondary: "#00FA9A",
            },
            fontFamily: {
                sans: 'Inter, ui-serif',
            }
        },
    },
}
