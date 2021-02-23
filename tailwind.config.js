module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    colors: {
      blue: {
        light : '#47cdff'
      }
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

