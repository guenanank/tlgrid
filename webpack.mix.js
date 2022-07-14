const mix = require('laravel-mix');

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

const node = 'node_modules/'

mix.styles(node + 'bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.css')
mix.copy(node + 'bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap.js')

mix.styles(node + '@fortawesome/fontawesome-free/css/all.min.css', 'public/css/fontawesome.css')
mix.copy(node + '@fortawesome/fontawesome-free/js/fontawesome.min.js', 'public/js/fontawesome.js')
mix.copyDirectory(node + '@fortawesome/fontawesome-free/svgs', 'public/svgs')
mix.copyDirectory(node + '@fortawesome/fontawesome-free/sprites', 'public/sprites')
mix.copyDirectory(node + '@fortawesome/fontawesome-free/webfonts', 'public/webfonts')

mix.styles(node + 'sweetalert2/dist/sweetalert2.min.css', 'public/css/sweetalert.css')
mix.copy(node + 'sweetalert2/dist/sweetalert2.min.js', 'public/js/sweetalert.js')

mix.styles([
    node + 'stisla/assets/css/style.css',
    node + 'stisla/assets/css/components.css'
], 'public/css/stisla.css')

mix.copy(node + 'jquery/dist/jquery.min.js', 'public/js/jquery.js')
mix.copy(node + 'popper.js/dist/umd/popper.min.js', 'public/js/popper.js')
mix.copy(node + 'tooltip.js/dist/umd/tooltip.min.js', 'public/js/tooltip.js')
mix.copy(node + 'jquery.nicescroll/dist/jquery.nicescroll.min.js', 'public/js/nicescroll.js')
mix.copy(node + 'moment/min/moment-with-locales.min.js', 'public/js/moment.js')
mix.copy(node + 'stisla/assets/js/stisla.js', 'public/js/stisla.js')
mix.copy(node + 'stisla/assets/js/scripts.js', 'public/js/stisla-scripts.js')
mix.copy(node + 'autosize/dist/autosize.min.js', 'public/js/autosize.js')

mix.styles([
    node + 'datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    node + 'datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',
    node + 'datatables.net-select-bs4/css/select.bootstrap4.min.css'
], 'public/css/datatables.css')
mix.copy(node + 'datatables.net/js/jquery.dataTables.min.js', 'public/js/jquery.dataTables.js')
mix.copy(node + 'datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'public/js/dataTables.bootstrap4.js')
mix.copy(node + 'datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js', 'public/js/responsive.bootstrap4.js')
mix.copy(node + 'datatables.net-select-bs4/js/select.bootstrap4.min.js', 'public/js/select.bootstrap4.js')

mix.styles(node + 'select2/dist//css/select2.min.css', 'public/css/select2.css')
mix.copy(node + 'select2/dist/js/select2.full.min.js', 'public/js/select2.js')

mix.styles(node + 'summernote/dist/summernote-bs4.min.css', 'public/css/summernote.css')
mix.copy(node + 'summernote/dist/summernote-bs4.min.js', 'public/js/summernote.js')
mix.copyDirectory(node + 'summernote/dist/font', 'public/font')

mix.sass(node + 'bootstrap-colorpicker/src/sass/colorpicker.scss', 'public/css/colorpicker.css')
mix.copy(node + 'bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js', 'public/js/colorpicker.js')

mix.styles(node + 'bootstrap-tagsinput/dist/bootstrap-tagsinput.css', 'public/css/tagsinput.css')
mix.copy(node + 'bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js', 'public/js/tagsinput.js')

mix.sass(node + 'bootstrap-fileinput/scss/fileinput.scss', 'public/css/fileinput.css')
mix.copy(node + 'bootstrap-fileinput/js/fileinput.min.js', 'public/js/fileinput.js')
mix.copy(node + 'bootstrap-fileinput/themes/fa/theme.min.js', 'public/js/fileinput-fa.js')
mix.copyDirectory(node + 'bootstrap-fileinput/img', 'public/img')


// ===========================================================================================

mix.sass('resources/scss/loader.scss', 'public/css/loader.css')
mix.js('resources/js/ajaxForm.js', 'public/js/ajaxForm.js')
mix.js('resources/js/datatables-language.js', 'public/js/datatables-language')
mix.js('resources/js/stisla.js', 'public/js/stisla.js')
mix.js('resources/js/summernote-fontawesome.js', 'public/js/summernote-fontawesome.js')

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

if (mix.inProduction()) {
    mix.version();
}