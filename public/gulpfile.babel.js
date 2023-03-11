const babel = require('gulp-babel');
const { series, src, dest} = require('gulp');
var minify = require('gulp-minify');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");
var gulpCopy = require('gulp-copy');

function copyFileBootstrapCss()
{
    return src([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'node_modules/bootstrap/dist/css/bootstrap.css.map',
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/bootstrap/dist/css/bootstrap.min.css.map',
        'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js.map',
        'node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js.map',
    ])
    .pipe(dest('assets/bootstrap/'));
};

function copyFileBootstrap()
{
    return src([
        'node_modules/bootstrap/dist/js/bootstrap.js', 
        'node_modules/bootstrap/dist/js/bootstrap.bundle.js', 
        'node_modules/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
        'node_modules/bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.es.js',
        'node_modules/bootstrap-notify/bootstrap-notify.min.js',
        'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js',
        'node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
        'node_modules/jasny-bootstrap/dist/js/jasny-bootstrap.min.js'
    ])
    .pipe(babel({
        presets: ['@babel/env']
    }))
    .pipe(dest('assets/bootstrap/'));
};

function copyFileJquery()
{
    return src([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/jquery-bootstrap-wizard/jquery.bootstrap.wizard.min.js'
    ])
    .pipe(babel({
        presets: ['@babel/env']
    }))
    .pipe(dest('assets/jquery/'));
};

function copyFileNouisliderCss()
{
    return src([
        'node_modules/nouislider/dist/nouislider.min.css',
    ])
    .pipe(dest('assets/nouislider/'));
};

function copyFileNouislider()
{
    return src([
        'node_modules/nouislider/dist/nouislider.min.js'
    ])
    .pipe(babel({
            presets: ['@babel/env']
        }))
    .pipe(dest('assets/nouislider/'));
};

function copyFilePerfectScrollbar()
{
    return src([
        'node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js',
    ])
    .pipe(babel({
            presets: ['@babel/env']
        }))
    .pipe(dest('assets/perfect-scrollbar/'));
};

function copyFilePerfectScrollbarCss()
{
    return src([
        'node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js.map',
        'node_modules/perfect-scrollbar/css/perfect-scrollbar.css',
    ])
    .pipe(dest('assets/perfect-scrollbar/'));
};

function copyFileMoment()
{
    return src([
        'node_modules/moment/moment.js',
        'node_modules/moment/dist/locale/es.js'
    ])
    .pipe(babel())
    .pipe(dest('assets/moment/'));
};

function copyFileMomentMap()
{
    return src([
        'node_modules/moment/min/moment.min.js.map'
    ])
    .pipe(dest('assets/moment/'));
};

function copyFileChartMap()
{
    return src([
        'node_modules/chart.js/dist/chart.js.map',
    ])
    .pipe(dest('assets/chart/'));
};

function copyFileChart()
{
    return src([
        'node_modules/chart.js/dist/chart.js',
    ])
    .pipe(babel({
            presets: ['@babel/env']
        }))
    .pipe(dest('assets/chart/'));
};

function copyFrameworkMap()
{
    return src([
        'node_modules/backbone/backbone-min.js.map',
        'node_modules/underscore/underscore-min.js.map',
    ])
    .pipe(dest('assets/framework/'));
};

function copyFramework()
{
    return src([
        'node_modules/backbone/backbone-min.js',
        'node_modules/underscore/underscore-min.js'
    ])
    .pipe(babel({
            presets: ['@babel/env']
        }))
    .pipe(dest('assets/framework/'));
};

function copySweetalert2Css()
{
    return src([
        'node_modules/sweetalert2/dist/sweetalert2.min.css',
    ])
    .pipe(dest('assets/sweetalert2/'));
};

function copySweetalert2()
{
    return src([
        'node_modules/sweetalert2/dist/sweetalert2.js'
    ])
    .pipe(babel())
    .pipe(uglify())
    .pipe(minify())
    .pipe(dest('assets/sweetalert2/'));
};

function copyFontAwesomeCss()
{
    return src([
        'node_modules/font-awesome/css/font-awesome.min.css'
    ])
    .pipe(dest('assets/font-awesome/css/'));
};

function copyFontAwesomeFonts()
{
    return src([
        'node_modules/font-awesome/fonts/*.*'
    ])
    .pipe(dest('assets/font-awesome/fonts/'));
};

function clientes(){
    return src([
        'src/models/core.js',
        'src/models/municipio.js',
        'src/models/cliente.js',
        'src/collections/clientes.js',
        'src/collections/municipios.js',
        'src/views/core.js',
        'src/views/clientes.js',
        'src/routers/clientes.js'
    ])
    .pipe(concat('build.clientes.js'))
    .pipe(babel())
    .pipe(uglify())
    .pipe(dest('resource/cliente/'));
};

function copyFileAxiosMap()
{
    return src([
        'node_modules/axios/dist/axios.min.js.map'
    ])
    .pipe(dest('assets/axios/'));
};

function copyFileAxios()
{
    return src([
        'node_modules/axios/dist/axios.min.js'
    ])
    .pipe(babel({
        presets: ['@babel/env']
    }))
    .pipe(dest('assets/axios/'));
};

function copyFileDatatable()
{
    return src([
        'node_modules/datatables.net/js/jquery.dataTables.js'
    ])
    .pipe(babel())
    .pipe(uglify())
    .pipe(minify())
    .pipe(dest('assets/datatable/'));
};

function copyFileChosen()
{
    return src([
        'node_modules/chosen-js/chosen.jquery.js'
    ])
    .pipe(babel())
    .pipe(uglify())
    .pipe(minify())
    .pipe(dest('assets/chosen/'));
};

function copyFileSortable()
{
    return src([
        'node_modules/sortablejs/Sortable.js'
    ])
    .pipe(babel())
    .pipe(uglify())
    .pipe(minify())
    .pipe(dest('assets/sortablejs/'));
};

function copyFileChosenRq()
{
    return src([
        'node_modules/chosen-js/chosen-sprite.png',
        'node_modules/chosen-js/chosen-sprite@2x.png',
        'node_modules/chosen-js/chosen.css'
    ])
    .pipe(dest('assets/chosen/'));
};

function login(){
    return src([
        'src/models/core.js',
        'src/models/login.js',
        'src/views/login.js',
        'src/routers/login.js'
    ])
    .pipe(concat('build.login.js'))
    .pipe(babel())
    .pipe(uglify())
    .pipe(dest('resource/login/'));
}

function usuarios(){
    return src([
        'src/models/core.js',
        'src/models/usuario.js',
        'src/collections/usuarios.js',
        'src/views/core.js',
        'src/views/usuarios.js',
        'src/routers/usuarios.js'
    ])
    .pipe(concat('build.usuarios.js'))
    .pipe(babel())
    .pipe(uglify())
    .pipe(dest('resource/usuario/'));
};

function perfil(){
    return src([
        'src/models/core.js',
        'src/models/usuario.js',
        'src/views/core.js',
        'src/views/perfil.js',
        'src/routers/perfil.js'
    ])
    .pipe(concat('build.perfil.js'))
    .pipe(babel())
    .pipe(uglify())
    .pipe(dest('resource/perfil/'));
};


exports.default = series(
    login,
    clientes,
    usuarios,
    perfil,
    copyFileSortable,
    // copyFileChosen,
    // copyFileChosenRq
    // copyFileDatatable
    // copyFileAxios,
    // copyFileAxiosMap,
    // copyFileBootstrap,
    // copyFileBootstrapCss,
    // copyFileJquery,
    // copyFileNouislider,
    // copyFileNouisliderCss,
    // copyFilePerfectScrollbar,
    // copyFilePerfectScrollbarCss,
    // copyFileMomentMap,
    // copyFileMoment,
    // copyFileChartMap,
    // copyFileChart,
    // copyFramework,
    // copyFrameworkMap,
    // copySweetalert2,
    // copySweetalert2Css,
    // copyFontAwesomeCss,
    // copyFontAwesomeFonts
);