module.exports = {
  theme: {
    extend: {}
  },
  variants: {},
  corePlugins: {
    container: false,
  },
  plugins: [
    require('tailwind-bootstrap-grid')({
      gridGutterWidth: '30px',
    })
  ]
}