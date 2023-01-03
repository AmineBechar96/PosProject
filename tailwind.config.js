/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        'color-gray':'#fafaf9'
      },
      fontFamily: {
        'quicksand': ['"Quicksand"', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('tailwindcss-rtl'),
    require('flowbite/plugin')
  ],
}
