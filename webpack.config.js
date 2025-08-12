const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  mode: 'development',
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/evaluacionespecialistas/index' : './src/js/evaluacionespecialistas/index.js',
    'js/evaluacionformulario/index' : './src/js/evaluacionformulario/index.js',
    'css/evaluacionformulario/style' : './src/css/evaluacionformulario/style.css',
    'css/evaluacionespecialistas/style' : './src/css/evaluacionespecialistas/style.css',
    'js/evaluacionformulario/index2' : './src/js/evaluacionformulario/index2.js',
    'css/evaluacionformulario/index2' : './src/css/evaluacionformulario/index2.css',
    'js/estadisticas/index' : './src/js/estadisticas/index.js'
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: '[name].css'  
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpe?g|gif)$/,
        type: 'asset/resource',
      },
    ]
  }
};