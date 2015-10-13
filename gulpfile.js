var elixir = require('laravel-elixir');

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
	
gulp.task('delete', function(cb){
  //start the proces.	
  process.stdout.write('Start cleanup remote folder...\n'); 
  
  gulp.src(remotePath)
  .pipe(conn.rmdir(remotePath + 'app/', cb ))//actually deleting files.
  .pipe(conn.rmdir(remotePath + 'bootstrap/', cb ))//actually deleting files.
  .pipe(conn.rmdir(remotePath + 'config/', cb ))//actually deleting files.
  .pipe(conn.rmdir(remotePath + 'public/', cb ))//actually deleting files.
  .pipe(conn.rmdir(remotePath + 'resources/', cb ))//actually deleting files.
  .pipe(conn.rmdir(remotePath + 'tests/', cb ));//actually deleting files.
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