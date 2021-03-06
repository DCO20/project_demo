const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();

// Geral
mix.combine(
    [
        "node_modules/admin-lte/plugins/fontawesome-free/css/all.css",
        "node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css",
        "node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css",
        "node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.css",
        "node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.css",
        "node_modules/admin-lte/plugins/select2/css/select2.css",
        "node_modules/admin-lte/dist/css/adminlte.css",
        "node_modules/admin-lte/plugins/summernote/summernote-bs4.css",
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
        "node_modules/moment/moment.js",
        "node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.js",
        "resources/js/jquery.mask.js",
        "node_modules/admin-lte/dist/js/adminlte.js",
        "node_modules/admin-lte/plugins/summernote/summernote-bs4.js",
        "node_modules/admin-lte/scripts/script.js",
    ],
    "public/js/adminlte.js"
);

// Categoria JS
mix.scripts(
    "Modules/Category/Resources/assets/js/category.js",
    "public/js/category.js"
);

// Produto JS
mix.scripts(
    "Modules/Product/Resources/assets/js/product.js",
    "public/js/product.js"
);

// Fornecedor JS
mix.scripts(
    "Modules/Purveyor/Resources/assets/js/purveyor.js",
    "public/js/purveyor.js"
);

// Cliente JS
mix.scripts(
    "Modules/Client/Resources/assets/js/client.js",
    "public/js/client.js"
);

// Pedido JS
mix.scripts("Modules/Suit/Resources/assets/js/suit.js", "public/js/suit.js");
