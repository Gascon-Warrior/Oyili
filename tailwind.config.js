/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors:{
        'th-orange': '#EB620C',
      },
      fontSize:{
        'th-h1': '90px',
        'th-subtittle': '28px',
      },
      letterSpacing:{
        'th-h1': '-4px',
      },
      fontFamily:{
        'th-title': ['Palanquin Dark', 'helvetica', 'arial', 'sans-serif'],
      },
      backgroundImage: {
        'dot': "url('/images/dot.svg')",        
      },
      animation:{
        'dot-line': 'dot-line 30s linear infinite'
      },
      keyframes:{
        'dot-line': {
          '0%': { transform: 'translateY(-50%)' },
          '100%': { transform: 'translateY(0)' },          
        }
      }
    },
  },
  plugins: [],
}

