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
    .extract([
        'jquery', 'datatables.net', 'datatables.net-bs4', 'datatables.net-responsive'
    ])
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery', 'jquery'],
        DataTable : ['datatables.net-bs4', 'datatables.net-responsive']
    })
    .sass('resources/sass/app.scss', 'public/css');

mix.js("resources/js/dt.js", "public/js/dt.js")
.sass("resources/sass/dt.scss", "public/css/dt.css");

mix.scripts([
    'node_modules/datatables.net/js/jquery.dataTables.js',
    'node_modules/datatables.net-dt/js/dataTables.dataTables.js',
    'node_modules/datatables.net-responsive/js/dataTables.responsive.js',
    'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js'
   ], 'public/js/datatables.js')
    .styles([
     'node_modules/datatables.net-dt/css/dataTables.dataTables.css',
     'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'
    ], 'public/css/datatables.css');
