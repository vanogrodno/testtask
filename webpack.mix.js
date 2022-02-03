const mix = require('laravel-mix');

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

mix.styles([
    'resources/vendor/mdi-font/css/material-design-iconic-font.min.css',
    'resources/vendor/font-awesome-4.7/css/font-awesome.min.css',
    'resources/vendor/select2/select2.min.css',
    'resources/vendor/datepicker/daterangepicker.css',
    'resources/css/main.css'
],'public/css/admin.css');
mix.scripts([
    'resources/vendor/jquery/jquery.min.js',
    'resources/vendor/select2/select2.min.js',
    'resources/vendor/datepicker/moment.min.js',
    'resources/vendor/datepicker/daterangepicker.js',
    'resources/js/global.js'
],'public/js/admin.js');