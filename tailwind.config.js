/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        mist: '#a3a3a3',
        'ice-blue': '#60a5fa',
        obsidian: '#050505',
        charcoal: '#121212',
        pebble: '#1f1f1f',
      },
    },
  },
  plugins: [],
}
