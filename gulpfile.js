var gulp           = require('gulp'),
    concat         = require('gulp-concat'),
    uglify         = require('gulp-uglify'),
    rename         = require('gulp-rename'),
    sass           = require('gulp-sass'),
    sourcemaps     = require('gulp-sourcemaps'),
    livereload     = require('gulp-livereload');

gulp.task('styles', function() {
    return gulp.src('./src/scss/main.scss')
        .pipe(sourcemaps.init())
        .pipe(sass.sync({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(livereload())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./assets/css/'));
});

gulp.task('scripts', function() {
    return gulp.src(['./src/js/main.js', './src/js/modules/**/*.js'])
		.pipe( sourcemaps.init() )
		.pipe( concat( "all.min.js" ) )
		.pipe( uglify() )
		.pipe( rename( "main.min.js" ) )
		.pipe( livereload() )
		.pipe( sourcemaps.write() )
		.pipe( gulp.dest( "assets/js" ) );
});

gulp.task('build-styles', function() {
	return gulp.src('./src/scss/main.scss')
		.pipe(sass.sync({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(rename({ extname: '.min.css' }))
		.pipe(gulp.dest('./assets/css/'));
});

gulp.task('build-scripts', function() {
	return gulp.src(['./src/js/main.js', './src/js/modules/**/*.js'])
		.pipe( concat( "all.min.js" ) )
		.pipe( uglify() )
		.pipe( rename( "main.min.js" ) )
		.pipe( gulp.dest( "assets/js" ) );
});

gulp.task('watch', function() {
   livereload.listen(35729);
   gulp.watch('./src/scss/**/*.scss', ['styles']);
   gulp.watch('./src/js/**/*.js', ['scripts']);
});

gulp.task('build', ['build-styles', 'build-scripts']);
gulp.task('default', ['styles', 'scripts', 'watch']);
