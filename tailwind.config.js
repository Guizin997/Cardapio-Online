/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      'sans': ['Roboto', 'sans-serif']
    },
    extend: {
      backgroundImage: {
        "home": "url('/public/assets/bg.png')"
      }
    },
  },
  plugins: [],
}