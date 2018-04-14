let mix = require('laravel-mix');
let webpack = require('webpack');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.webpackConfig({
     plugins: [
        new webpack.ProvidePlugin({
            '$': 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            Popper: ['popper.js', 'default']
        })
     ]
 })
 .autoload({ jquery: ['$', 'window.jQuery', 'jQuery'] })
//  .copy('node_modules/owl.carousel/dist/owl.carousel.js', 'public/js')
 .js('resources/assets/js/app.js', 'public/js/app.js')
 .js('resources/assets/js/index.js', 'public/js/index.js')
 .sass('resources/assets/sass/app.scss', 'public/css/app.css')
 .sass('resources/assets/sass/custom.scss', 'public/css/custom.css')
 .sourceMaps();