var gulp = require('gulp');
var ftp = require('vinyl-ftp');
var gutil = require('gulp-util');
var minimist = require('minimist');
var args = minimist(process.argv.slice(2));
// All the plugins which are necesarry 
 
gulp.task('deploy', function() {
	
  //start the proces.	
  process.stdout.write('Transfering files...\n');

  //the path where to store it.	
  var remotePath = '/brandweer/';

  //the connection where its going to be loaded.
  var conn = ftp.create({
    host: 'scrumbag.nl',
    user: args.user,
    password: args.password,
	parallel: 10,
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

  //Delete and after newer to the new destination.
  gulp.src( globs, { base: '.', buffer: false } )
    .pipe(conn.rmdir(remotePath)) 
    .pipe(conn.newer(remotePath))
    .pipe(conn.dest(remotePath));
	
	//write out it has been finisht after the finish.
	process.stdout.write('Transfer complete...\n');
});
