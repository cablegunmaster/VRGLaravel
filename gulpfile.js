var gulp = require('gulp');
var ftp = require('vinyl-ftp');
var gutil = require('gulp-util');
var minimist = require('minimist');
var args = minimist(process.argv.slice(2));
 
gulp.task('deploy', function() {
  var remotePath = '/brandweer/';
  var conn = ftp.create({
    host: 'scrumbag.nl',
    user: args.user,
    password: args.password,
    log: gutil.log
  });
 
  gulp.src(['./**/*.png', './**/*.jpg', './**/*.css', './**/*.php', './**/*.html','./**/*.txt'])
    .pipe(conn.newer(remotePath))
    .pipe(conn.dest(remotePath));
});
