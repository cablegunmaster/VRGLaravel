var elixir = require('laravel-elixir');
var gulp = require('gulp'); //the tool to add all the files and make streams.
var ftp = require('vinyl-ftp'); // FTP upload 
var gutil = require('gulp-util'); //extra tooling.
var minimist = require('minimist'); //to minimize the args
var args = minimist(process.argv.slice(2)); //to read the arguments
// All the plugins which are necessary 

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});


//the path where to store it.	
var remotePath = '/brandweer/';

//the connection where its going to be loaded.
var conn = ftp.create({
host: 'scrumbag.nl',
user: args.user,
password: args.password,
parallel: 10
});
		
gulp.task('delete', function(){
  //start the proces.	
  process.stdout.write('Start cleanup remote folder...\n'); 
  
  conn.rmdir(remotePath + 'app/');//actually deleting files.
  conn.rmdir(remotePath + 'bootstrap/');//actually deleting files.
  conn.rmdir(remotePath + 'config/');//actually deleting files.
  conn.rmdir(remotePath + 'public/');//actually deleting files.
  conn.rmdir(remotePath + 'resources/');//actually deleting files.
  conn.rmdir(remotePath + 'tests/');//actually deleting files.
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

  gulp.src( globs, { base: '.', buffer: false } )
    .pipe(conn.newer(remotePath))
    .pipe(conn.dest(remotePath));
	
	//write out it has been finisht after the finish.
	process.stdout.write('Transfer complete...\n');
});