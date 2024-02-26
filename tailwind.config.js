/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.css",
    "./resources/**/*.vue",
    // "./public/js/*.js",
    // "./public/css/*.css",
    // "./public/**/*.{js,ts,jsx,tsx}",
    // "./public/**/*.{html,js}",
    // "./node_modules/tw-elements/dist/js/**/*.js",
    // "./index.html",
  ],
  theme: {
    extend: {
      colors: {
        "darkMode": "#222831",
        "darkModeText": "#000000",
        "bgMain" : "#DFDFDE",

      },
      backgroundImage: theme => ({
        'homepage': "url('/public/assets/bg2.png')",
      }),
    },
  },
  plugins: [],
}
