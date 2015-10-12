var gulp = require('gulp');
var ftp = require('vinyl-ftp');
var gutil = require('gulp-util');
var minimist = require('minimist');
var args = minimist(process.argv.slice(2));
 
gulp.task('deploy', function() {
	
	process.stdout.write('Transfering files...\n');
	
  var remotePath = '/brandweer/';
  var conn = ftp.create({
    host: 'scrumbag.nl',
    user: args.user,
    password: args.password,
    log: gutil.log
  });
  
	/**
	* Example of files and folders to be uploaded.
	*/
     var globs = [
		'*',
        'app/**',
        'bootstrap/**',
        'config/**',
        'public/**',
        'resources/lang/**',
        'resources/views/**',
		'!node_modules',
		'!node_modules/**',
    ];
	
  gulp.src( globs, { base: '.', buffer: false } )
    .pipe(conn.newer(remotePath))
    .pipe(conn.dest(remotePath));
	
	process.stdout.write('Transfer complete...\n');
});
