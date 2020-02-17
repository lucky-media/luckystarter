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
    .js("resources/js/admin/app.js", "public/admin/js")
    .sass("resources/sass/admin/app.scss", "public/admin/css")
    .copyDirectory("resources/js/admin/vendors", "public/admin/js/vendors")
    .copyDirectory("resources/sass/admin/fonts", "public/admin/css/fonts")
    .options({
        processCssUrls: false,
    });

// Frontend Assets
mix
    .js("resources/js/frontend/app.js", "public/front/js")
    .sass("resources/sass/frontend/app.scss", "public/front/css")
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss() ],
    });

if(mix.inProduction())
{
    mix.purgeCss();
}