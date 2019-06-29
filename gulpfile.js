var gulp= require('gulp');
var $ = require('gulp-load-plugins')();
var minifyCSS = require('gulp-minify-css');
var mainBowerFiles=require('main-bower-files');
var replace = require('gulp-replace-pro');


gulp.task('scss', function () {
    return gulp.src('./scss/*.scss')
        .pipe($.sass().on('error', $.sass.logError))
        .pipe($.autoprefixer())
        .pipe(gulp.dest('./.tmp/css'))
});

//先講檔案載入暫時的資料夾
gulp.task('bower', function () {
    return gulp.src(mainBowerFiles())
        .pipe(gulp.dest('./.tmp/vendors'))
});

//然後做出合併
gulp.task('vendorJs',['bower'],function(){
    return gulp.src(['./.tmp/vendors/**/*.js','./js/custom.js'])
    .pipe($.order([
        'jquery.js',
        'bootstrap.js'
    ]))
    .pipe($.concat('all.js'))
    .pipe($.uglify({
        compress:{
            drop_console:true //把console.log 削掉
        }
    }))                               
    .pipe(gulp.dest('./src'))
});

gulp.task('vendorCSS',['bower'],function(){    
    return gulp.src(['./.tmp/vendors/**/*.css','./.tmp/css/custom.css'])
    .pipe($.concat('./src/theme.css'))
    .pipe(minifyCSS())                            
    .pipe(gulp.dest('./'))
});

gulp.task('ChangeFontUrl',['vendorCSS'],function(){
    gulp.src(['./.tmp/style.css'])
    .pipe(replace('../fonts/', 'fonts/'))
    .pipe(gulp.dest('./'));
});

gulp.task('vendorFONT',['bower'],function(){
    return gulp.src("./.tmp/vendors/fontawesome-webfont.*")
                .pipe(gulp.dest('./fonts'))
});

gulp.task('image', function () {
    gulp.src('img/**/*')
        .pipe($.imagemin())
        .pipe(gulp.dest('images'));
});

//刪除資料夾
gulp.task('clean',function(){
    return gulp.src(['./.tmp','./public','./.publish','./img'],{read:false})
        .pipe($.clean())
});

gulp.task('cleantmp',['vendorJs','vendorCSS','vendorFONT','scss'],function(){
    return gulp.src(['./.tmp'],{read:false})
        .pipe($.clean())
});

gulp.task('dev', ['scss','vendorJs','vendorCSS','vendorFONT','cleantmp','watch']);

gulp.task('default', ['scss','vendorJs','vendorCSS','ChangeFontUrl','vendorFONT','image','cleantmp']);