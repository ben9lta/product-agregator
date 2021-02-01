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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin/admin.scss', 'admin_assets/compiled/admin.css')
    .sass('resources/sass/admin/icons.scss', 'admin_assets/compiled/icons.css')
    .styles([
        'public/admin_assets/compiled/admin.css',
        'public/admin_assets/compiled/icons.css'
    ], 'public/admin_assets/css/admin.css');

