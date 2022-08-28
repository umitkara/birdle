/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            sm: "640px",
            lg: "768px",
            xl: "1024px",
        },
        extend: {
            boxShadow: {
                light: "0 4px 10px -2px rgba(255, 255, 255, 0.15)",
            }
        },
    },
    plugins: [],
}
