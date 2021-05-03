const colors = require('tailwindcss/colors')  

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      primary: {
        100: '#FFFFD7', 200: '#FFF499', 300: '#FFE361',
        400: '#FFCF29', 500: '#FFC107', 600: '#FFB007',
        700: '#FF9F07', 800: '#FF8D07', 900: '#FA7600',
        DEFAULT:'#FFC107',
      },
      accent: {
        100: '#FEDEFB', 200: '#FCABFD', 300: '#F280FC',
        400: '#E75FFB', 500: '#DF41FB', 600: '#D141FB',
        700: '#C441FB', 800: '#B741FB', 900: '#A82DFF',
        DEFAULT: '#DF41FB',
      },
      black: colors.black,
      white: colors.white,
      gray: colors.coolGray,
      red: colors.red,
      yellow: colors.amber,
      blue: colors.blue,
      purple: colors.violet,
      green: colors.emerald,
    },
    fontFamily:{
      'body':['Overpass'],
      'headings':['Alegreya\\ Sans'],
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  corePlugins: {
    outline: false,
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
