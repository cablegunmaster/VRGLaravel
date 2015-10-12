var gulp = require('gulp'); //the tool to add all the files and make streams.
var ftp = require('vinyl-ftp'); // FTP upload 
var gutil = require('gulp-util'); //extra tooling.
var minimist = require('minimist'); //to minimize the args
var args = minimist(process.argv.slice(2)); //to read the arguments
var runSequence = require('run-sequence'); //to combine all the task.
var composer = require('gulp-composer'); //add the program to load laravel / plugins.
// All the plugins which are necessary 

//the path where to store it.	
var remotePath = '/brandweer/';

//the connection where its going to be loaded.
var conn = ftp.create({
host: 'scrumbag.nl',
user: args.user,
password: args.password,
parallel: 10
});
	
gulp.task('delete', function(cb){
  //start the proces.	
  process.stdout.write('Start cleanup remote folder...\n'); 
  conn.rmdir(remotePath, cb );//actually deleting files.
  // deleting files done.	
  process.stdout.write('Cleanup complete...\n');
});

//Deploy task to actually deploy the build itself.	
gulp.task('deploy', function() {

  //start the proces.	
  process.stdout.write('Transfering files...\n');

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
    .pipe(conn.newer(remotePath))
    .pipe(conn.dest(remotePath));
	
	//write out it has been finisht after the finish.
	process.stdout.write('Transfer complete...\n');
});

gulp.task('composer', function () {
	composer({ cwd: './php-stuff', bin: 'composer' }); //define location of composer.
	composer(); //default install
	composer('create-project laravel/laravel --prefer-dist', {}); //install laravel.
	composer('dumpautoload', {optimize: true}); //reload all pathways, and optimize cache.
});

// ### Build task.
gulp.task('build', function(callback) {
  runSequence('delete',
			  'composer',
              'deploy',
              callback);
});
