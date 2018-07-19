let mix = require('laravel-mix');

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

mix
    .copy('node_modules/bootstrap-daterangepicker', 'public/vendor/bootstrap-daterangepicker')
    .copy('node_modules/jquery/dist', 'public/vendor/jquery')
    .copy('node_modules/ol/ol.css', 'public/vendor/ol/ol.css')
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');