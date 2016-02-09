
var gulp = require("gulp");
var stylus = require("gulp-stylus");
var nib = require('nib');

gulp.task('Estilos', function(){
	gulp.src(['./unprg-stylus/*.styl'])
	.pipe(stylus({use : nib(),compress : true}))
	.pipe(gulp.dest("./unprg-htdocs/16/frontend/css"));
});

gulp.task('watch', function(){
	gulp.watch('./unprg-stylus/**/*.styl',['Estilos']);
});

gulp.task('default',['Estilos','watch']);