const mix = require('laravel-mix');

mix.webpackConfig({
    output: {
        chunkFilename: 'js/chunks/[name].js',
    },
})
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('postcss-nesting'),
        require('tailwindcss'),
    ])
    .sourceMaps()
    .version();
