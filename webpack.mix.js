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
    .sass('resources/sass/app.scss', 'public/css');



mix.sass('resources/sass/dashboard/dashboard.scss', 'public/css');

mix.js(
    [
        // 'resources/js/app.js',
        'public/plugins/jquery/jquery.min.js',
        'public/plugins/bootstrap/js/popper.min.js',
        'public/plugins/bootstrap/js/bootstrap.min.js',
        'public/js/perfect-scrollbar.jquery.min.js',
        // 'public/js/waves.js',
        // 'public/js/sidebarmenu.js',
        // 'public/js/custom.min.js',
        // 'public/plugins/sparkline/jquery.sparkline.min.js',
        // 'public/plugins/chartist-js/dist/chartist.min.js',
        // // 'public/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
        // // 'public/plugins/d3/d3.min.js',
        // 'public/plugins/c3-master/c3.min.js',
        // 'public/plugins/toast-master/js/jquery.toast.js',
        // 'public/js/dashboard1.js',
        // 'public/plugins/styleswitcher/jQuery.style.switcher.js',
    ], 'public/js/dashboard.js').version();
