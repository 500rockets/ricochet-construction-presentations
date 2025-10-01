/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{html,js}",
    "./public/presentations/**/*.{html,js}",
    "./public/services/**/*.{html,js}"
  ],
  theme: {
    extend: {
      colors: {
        'primary-green': '#10b981',
        'light-green': '#34d399', 
        'dark-green': '#059669',
        'dark-gray': '#374151',
        'light-gray': '#f3f4f6',
        'white': '#ffffff'
      },
      fontFamily: {
        'sans': ['Inter', 'system-ui', 'sans-serif']
      },
      animation: {
        'slideIn': 'slideIn 0.5s ease-in-out',
        'fadeIn': 'fadeIn 0.3s ease-in-out'
      },
      keyframes: {
        slideIn: {
          '0%': { opacity: '0', transform: 'translateX(20px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' }
        },
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' }
        }
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography')
  ],
}
