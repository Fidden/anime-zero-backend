require('laravel-mix-eslint');

const mix = require('laravel-mix');
const path = require('path');

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

mix.alias({
    ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue'), // or 'vendor/tightenco/ziggy/dist/vue' if you're using the Vue plugin
});

mix.disableNotifications();

mix.copyDirectory('resources/img', 'public/img');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sourceMaps(false, 'source-map')
    .postCss('resources/css/app.css', 'public/css')
    // .eslint({
    //     fix: false,
    //     extensions: ['js', 'vue'],
    //     exclude: ['node_modules', 'vendor', 'resources/js/bootstrap.js'],
    //     overrideConfig: {
    //         'env': {
    //             'browser': true,
    //             'es2021': true,
    //             'node': true,
    //         },
    //         'extends': [
    //             'eslint:recommended',
    //             'plugin:vue/vue3-recommended',
    //         ],
    //         'parserOptions': {
    //             'ecmaVersion': 'latest',
    //             'sourceType': 'module'
    //         },
    //         'plugins': [
    //             'vue'
    //         ],
    //         'rules': {
    //             'linebreak-style': [
    //                 'error',
    //                 'unix'
    //             ],
    //             'quotes': [
    //                 'error',
    //                 'single'
    //             ],
    //             'semi': [
    //                 'error',
    //                 'always'
    //             ],
    //             'vue/no-multiple-template-root': 'off',
    //             'vue/html-indent': 'off',
    //             'vue/html-closing-bracket-spacing': 'off',
    //             'vue/html-closing-bracket-newline': 'off',
    //         }
    //     }
    // });

mix.browserSync('http://127.0.0.1:8000');
