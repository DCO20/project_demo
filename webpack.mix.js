const mix = require("laravel-mix");

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

// Geral
mix.combine(
    [
        "node_modules/admin-lte/plugins/fontawesome-free/css/all.css",
        "node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css",
        "node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.css",
        "node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.css",
        "node_modules/admin-lte/plugins/select2/css/select2.css",
        "node_modules/admin-lte/dist/css/adminlte.css",
        "resources/css/style.css",
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

// Geral
mix.combine(
    [
        "node_modules/admin-lte/plugins/jquery/jquery.js",
        "node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js",
        "node_modules/admin-lte/plugins/datatables/jquery.dataTables.js",
        "node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js",
        "node_modules/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.js",
        "node_modules/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.js",
        "node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.js",
        "node_modules/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.js",
        "node_modules/admin-lte/plugins/select2/js/select2.js",
        "node_modules/admin-lte/dist/js/adminlte.js",
        "node_modules/admin-lte/scripts/script.js",
    ],
    "public/js/adminlte.js"
);

// Country JS
mix.scripts(
    "Modules/Country/Resources/assets/js/country.js",
    "public/js/country.js"
);

// Location JS
mix.scripts(
    "Modules/Location/Resources/assets/js/location.js",
    "public/js/location.js"
);

// State JS
mix.scripts(
    "Modules/State/Resources/assets/js/state.js",
    "public/js/state.js"
);
