const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management CSS
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.combine([
    "node_modules/admin-lte/plugins/fontawesome-free/css/all.css",
    "node_modules/admin-lte/dist/css/adminlte.css",
],
    "public/css/adminlte.css"
);


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management JS
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.combine([
    "node_modules/admin-lte/plugins/jquery/jquery.js",
    "node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js",
    "node_modules/admin-lte/dist/js/adminlte.js",
    "node_modules/admin-lte/scripts/script.js"
 ],
    "public/js/adminlte.js"
);
