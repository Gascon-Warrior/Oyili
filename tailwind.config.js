/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors:{
        'th-orange': '#EB610E',
        'th-orange-hover': '#d3570d',
        'th-beige' : '#EAE2CB',
        'th-vert' : '#A0AA8F',
        'th-turquoize' : '#91CDCF',
        'th-saumon' : '#F6DCCA',
        'th-rose' : '#EC7056',
        'th-noir' : '#46483C',
        'th-bleu' :'#0C324E',
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
        'th-palanquin': ['Palanquin', 'helvetica', 'arial', 'sans-serif'],
      },
      backgroundImage: {
        'dot': "url('/images/dot.svg')", 
        'color-line': "url('/images/bande-couleur.svg')",
        'color-line-offset': "url('/images/bande-couleur-decalee.svg')",   
        'seamless':  "url('/images/seamless.png')",
      },
      backgroundPosition:{
        'scrol-pos': 'var(--scrollPos)',
      },
      animation:{
        'dot-line': 'dot-line 30s linear infinite',
        'footer-text-anim': 'footer-text-anim 1s steps(8) infinite',
        'after-footer-anim': 'after-footer-anim 0.3s forwards',
        'slide-left': 'slideLeft 0.3s forwards',
        'slide-right': 'slideRight 0.3s forwards',

      },
      keyframes:{
        'dot-line': {
          '0%': { transform: 'translateY(-50%)' },
          '100%': { transform: 'translateY(0)' },          
        },
        'slideLeft' :{
          '0%': { transform: 'translateX(100%)' },
          '100%':  { transform: 'translateX(0)' },
        },
        'slideRight' :{
          '0%': { transform: 'translateX(0)' },
          '100%':  { transform: 'translateX(calc(100%+30px))' },
        },
        'footer-text-anim': {
          '0%': { fill: '#EAE2CB' },
          '14.2857%': { fill: '#EB610E' },
          '28.5714%': { fill: '#A0AA8F' },
          '42.8571%': { fill: '#91CDCF' },
          '57.1429%': { fill: '#F6DCCA' },
          '71.4286%': { fill: '#EC7056' },
          '85.7143%': { fill: '#46483C' },
          '100%': { fill: '#0C324E' },
        },
        'after-footer-anim': {
          '0%': { width: '0px' },
          '100%': { width: '30px' },
        },
      },
      zIndex: {
        '60': 60,
        '70': 70,
        '80': 80,
        '90': 90,
        '100': 100,
        // Vous pouvez ajouter autant de valeurs personnalisées que nécessaire
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
