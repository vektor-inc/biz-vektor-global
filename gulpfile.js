var gulp = require('gulp');

const { series } = require('gulp');

function watch(cb) {
	gulp.watch(['./*.php'], series(dist));
}

function dist(cb) {
	return gulp.src(
      [
        './**/*.php',
        './**/*.txt',
        './**/*.css',
        './**/*.png',
        './design-skin/**',
        './_scss/**',
        './bizvektor_themes/**',
        './css/**',
        './images/**',
        './inc/**',
        './js/**',
        "./languages/**",
        "!./node_modules/**/*.*"
      ], {
        base: './'
      }
    )
    .pipe(gulp.dest('../themes/bizvektor-global-edition'));
  cb();
}

// exports.build = build;
exports.default = series(watch,dist);
