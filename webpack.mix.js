let mix = require('laravel-mix');

mix.webpackConfig({
    output: {
        chunkFilename: 'js/chunks/[name].js',
    },
})
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
