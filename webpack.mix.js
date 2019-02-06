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

mix.autoload({
    jquery: ['$', 'global.jQuery', "jQuery", "global.$", "jquery", "global.jquery"]
});

mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/dashboard/dashboard.scss', 'public/css').sourceMaps();
mix.js('resources/js/dashboard/plugins/jquery/jquery.min.js', 'public/js');
mix.js(
    [
        // 'resources/js/dashboard/plugins/jquery/jquery.min.js',
        'resources/js/dashboard/plugins/bootstrap/js/popper.min.js',
        'resources/js/dashboard/plugins/bootstrap/js/bootstrap.min.js',
        'resources/js/dashboard/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js',
        'resources/js/dashboard/waves.js',
        'resources/js/dashboard/sidebarmenu.js',
        'resources/js/dashboard/plugins/sparkline/jquery.sparkline.min.js',
        'resources/js/dashboard/plugins/chartist-js/dist/chartist.min.js',
        'resources/js/dashboard/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
        'resources/js/dashboard/plugins/d3/d3.min.js',
        'resources/js/dashboard/plugins/c3-master/c3.min.js',
        'resources/js/dashboard/plugins/toast-master/js/jquery.toast.js',
        'resources/js/dashboard/plugins/styleswitcher/jQuery.style.switcher.js',
        'resources/js/dashboard/plugins/select2/dist/js/select2.full.min.js',

    ], 'public/js/dashboard.js').version();

mix.webpackConfig({
    resolve: {
        alias: {
            jquery: "jquery/src/jquery"
        }
    }
});