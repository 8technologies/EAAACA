const path = require('path');
const { IgnorePlugin } = require('webpack');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '@frontend': path.resolve('resources/jsFrontend'),
        },
    },
    plugins: [
        new IgnorePlugin({
            // resourceRegExp: /moment/,
            resourceRegExp: /^\.\/locale$/,
            contextRegExp: /moment$/,
        }),
    ],
};
