/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        bgColor: "#303030",
        primary: "#DB202C",
      }
    },
  },
  plugins: [],
}

