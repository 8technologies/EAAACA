const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/backend/js').vue()
    .postCss('resources/css/backend.css', 'public/backend/css', [])
    .webpackConfig(require('./webpack.config'))
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
        moment: ['moment','window.moment'],   
    })
    .extract()
    
if (mix.inProduction()) {
    mix.version();
}