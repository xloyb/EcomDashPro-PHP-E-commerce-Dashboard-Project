module.exports = {
  content: [
    "./admin/dashboard/**/*.php",
    "./dashboard/**/*.php",
    "./inc/**/*.php",
    "./*.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms'),
  ],
}


