// Importando o defaultTheme se necessário
// const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './views/**/*.php',
    ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Nanuto', 'sans-serif'], // Exemplo de uso de defaultTheme
      },
    },
  },
  plugins: [
    '@tailwindcss/forms',                 // Estilos predefinidos para formulários
    'tailwindcss-pseudo-elements',        // Suporte para pseudo-elementos CSS
    'tailwindcss-aspect-ratio',           // Adição de proporções de aspecto
    'tailwindcss-typography',             // Estilos consistentes de tipografia
    'tailwindcss-line-clamp',             // Suporte para a propriedade line-clamp
    'tailwindcss-spinner',                // Estilos de spinner para indicar carregamento
    // 'tailwindcss-animatecss',           // Adicionando animações do Animate.css (opcional, descomente se necessário)
    ],
};
