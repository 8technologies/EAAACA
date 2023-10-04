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

mix.js('resources/jsFrontend/app.js', 'public/frontend/js').vue()
    .postCss('resources/css/frontend.css', 'public/frontend/css', [])
    .webpackConfig( function() {
        const path = require('path');
        const { IgnorePlugin } = require('webpack');

        return module.exports = {
            resolve: {
                alias: {
                    '@': path.resolve('resources/js'),
                    '@frontend': path.resolve('resources/jsFrontend'),
                },
            },
            plugins: [
                new IgnorePlugin({
                    resourceRegExp: /ckeditor/,
                }),
                new IgnorePlugin({
                    resourceRegExp: /moment/,
                    // resourceRegExp: /^\.\/locale$/,
                    // contextRegExp: /moment$/,
                }),
            ],
        }
    })
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    })
    .extract()

if (mix.inProduction()) {
    mix.version();
}