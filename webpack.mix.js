let mix = require("laravel-mix");
const tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');

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

// Backend Assets
mix
    .js("resources/js/admin/app.js", "public/assets/admin/js")
    .sass("resources/sass/admin/app.scss", "public/assets/admin/css")
    .copyDirectory("resources/sass/admin/fonts", "public/assets/admin/fonts")
    .copyDirectory("resources/images", "public/assets/images")
    .options({
        processCssUrls: false,
    });

// Vendor Assets
mix.combine([
        'resources/js/admin/vendors/jquery-3.2.1.min.js',
        'resources/js/admin/vendors/bootstrap.bundle.min.js',
        'resources/js/admin/vendors/selectize.min.js',
        'resources/js/admin/vendors/dataTables.min.js',
        'resources/js/admin/vendors/toastr.min.js'
    ], 'public/assets/admin/js/vendor.js'
);

// Frontend Assets
mix
    .js("resources/js/frontend/app.js", "public/assets/front/js")
    .sass("resources/sass/frontend/app.scss", "public/assets/front/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss()],
    });

if (mix.inProduction()) {
    mix.purgeCss();
}