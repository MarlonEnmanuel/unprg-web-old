
var gulp = require("gulp");
var stylus = require("gulp-stylus");
var nib = require('nib');

gulp.task('Estilos', function(){
	gulp.src(['./unprg-stylus/*.styl'])
	.pipe(stylus({use : nib(),compress : true}))
	.pipe(gulp.dest("./unprg-htdocs/unrpg-nueva/frontend/css"));
});

gulp.task('CopiarTodo', function(){
	gulp.src('./unprg-htdocs/**/*.*')
	.pipe(gulp.dest("C://xampp/htdocs/unprg"));
});

gulp.task('watch', function(){
	gulp.watch('./unprg-stylus/**/*.styl',['Estilos']);
	gulp.watch('./unprg-htdocs/**/*.*', ['CopiarTodo']);
});

gulp.task('default',['CopiarTodo','watch']);