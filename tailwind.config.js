/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    colors: {
      black: 'hsl(var(--color-black) / <alpha-value>)',
      primary: 'hsl(var(--color-primary) / <alpha-value>)',
      darkGrey: 'hsl(var(--color-dark-grey) / <alpha-value>)',
      grey: 'hsl(var(--color-grey) / <alpha-value>)',
      white: 'hsl(var(--color-white) / <alpha-value>)',
      danger: 'hsl(var(--color-danger) / <alpha-value>)',
    },
    screens: {
      'sm': '641px',
      'md': '769px',
    },
    extend: {},
  },
  plugins: [],
}