const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/styles.scss', 'public/css');

//Automatic loading
mix.browserSync("http://crm.test")
