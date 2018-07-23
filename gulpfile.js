const gulp = require('gulp');
const sass = require('gulp-sass');

gulp.task('sass',()=> {
	return gulp.src([
		//'node_modules/bootstrap/scss/bootstrap.scss',
		'plantillas/scss/*.scss'
	])
	.pipe(sass({
		outputStyle:'expanded'
	}))
	.pipe(gulp.dest('plantillas/css'));
})

gulp.task('checksass',['sass'],()=> {
	gulp.watch([
		//'node_modules/bootstrap/scss/bootstrap.scss',
		'plantillas/scss/*.scss'
	],['sass']);
})

gulp.task('default',['checksass']);