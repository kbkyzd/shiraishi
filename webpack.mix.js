let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .babel('resources/assets/js/legacy/*', 'public/js/legacy.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/minimal.scss', 'public/css')
   .copyDirectory('resources/assets/images', 'public/images');


mix.disableNotifications();

if (mix.inProduction()) {
    mix.version();
}

if (!mix.inProduction()) {
    mix.sourceMaps();
}

mix.webpackConfig({
    node: {
        fs: 'empty',
    }
});

mix.browserSync({
    https: process.env.MIX_BS_USE_HTTPS || false,
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
