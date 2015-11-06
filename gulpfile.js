var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.styles([
        'vendor/bootstrap.css',
        'vendor/jquery-ui.css',
        'vendor/select2.css',
        'vendor/select2-bootstrap.css',
        'vendor/flatly-bootstrap-theme.css',
        'app.css'
    ], null, 'public/css')
});
