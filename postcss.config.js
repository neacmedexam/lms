// module.exports = {
//   plugins: {
//     tailwindcss: {},
//     autoprefixer: {},
//   },
// }


/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.css",
    "./resources/**/*.vue",
    "./index.html",
    "./public/**/*.{js,ts,jsx,tsx}",
    "./public/**/*.{html,js}",
  ],
  theme: {
    extend: {
      colors: {
        "darkMode": "#222831",
        "darkModeText": "#EEEEEE",
        "bgMain" : "#DFDFDE",

      },
      backgroundImage: theme => ({
        'homepage': "url('/public/assets/bg2.png')",
      }),
    },
  },
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
}
