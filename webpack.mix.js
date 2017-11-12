let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .copyDirectory('resources/assets/images', 'public/images');


mix.disableNotifications();

if (mix.inProduction()) {
    mix.version();
}

if (! mix.inProduction()) {
    mix.sourceMaps();
}

mix.browserSync({
    proxy: {
        target: 'localhost:8000',
        reqHeaders() {
            return {
                host: 'localhost:3000'
            };
        }
    },
    notify: false
});