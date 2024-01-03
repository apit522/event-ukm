/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {
          fontFamily: {
            'volkhov': ['Volkhov', 'sans-serif'],
             },
          colors: {
              transparent: 'transparent',
              current: 'currentColor',
              'primary': '#271C6D',
              'secondary': '#2F2FA2',
              'ping': '#F64C72',
              'oren': '#DF6951',
              'ungu': '#98738D',

            },
      },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('flowbite/plugin')
    ],
  }

