const babel = require('gulp-babel');
const { series, src, dest} = require('gulp');
var minify = require('gulp-minify');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");

function clientes(){
    return src([
        'src/models/core.js',
        'src/models/cliente.js',
        'src/collections/clientes.js',
        'src/views/core.js',
        'src/views/clientes.js',
        'src/routers/clientes.js'
    ])
    .pipe(babel())
    .pipe(uglify())
    .pipe(concat('build.clientes.js'))    
    .pipe(minify())
    .pipe(dest('js/comserva/'));
};

exports.default = series(
    clientes
);