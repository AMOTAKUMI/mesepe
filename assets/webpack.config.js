const webpack = require('webpack');
const path    = require('path');
const MINIFY  = process.env.NODE_MINIFY === '1';

module.exports = {
  watch: true,
  context: path.join(__dirname, './src/js'),
  entry: './main.js',
  output: {
    path: path.join(__dirname, '/dist'),
    filename: MINIFY ? 'bundle.min.js' : 'bundle.js',
  },
  resolve: {
    modules: [
      path.resolve(__dirname, 'src'),
      'node_modules',
    ],
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {},
        },
      },
      {
        test: /\.scss$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options: {
              url: false,
              importLoaders: 1,
              plugins: function () {
                return [
                  require('autoprefixer')
                ];
              }
            },
          },
          'postcss-loader',
          'sass-loader',
        ],
      }
    ],
  },
  plugins: [
    /*
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        drop_console: true
      },
    }),
    */
    new webpack.ProvidePlugin({
      jQuery: "jquery",
      $     : "jquery",
      jquery: "jquery",
      THREE  : "three/build/three"
    }),
  ],
};
