/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');

	var task_name = 'libraries';
	var task_description = 'This task will concat and minify all frontend library folders from "/frontend/libraries".';

	// Task
	grunt.registerTask(task_name, task_description, function() {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// load libraries default json
		var libraries = grunt.file.readJSON("../frontend/libraries/libraries.json");

		// looping through frontend folders (except libraries folder)
		grunt.file.expand(['../frontend/*', '!../frontend/libraries']).forEach(function(dir) {

			// frontend folder's name
			var frontend_folder_name = dir.match(/([^\/]*)\/*$/)[1];

			// frontend folder's selected libraries
			var frontend_libraries = grunt.file.readJSON('../frontend/' + frontend_folder_name + '/libraries.json');

			var js = new Array();
			var css = new Array();
			var files = new Array();

			// looping through frontend folder's selected libraries
			for (var key in frontend_libraries['libraries']) {

				/*
				* Build to-do list for this frontend folder's libraries
				*
				*/

				// only production files
				if (libraries[key]['autoload']['production'] == true) {

					// Has JS
					if ( typeof libraries[key]['js'] !== "undefined") {

						// merge arrays
						var js = js.concat(libraries[key]['js']);

					}

					// Has CSS
					if ( typeof libraries[key]['css'] !== "undefined") {

						// merge arrays
						var css = css.concat(libraries[key]['css']);

					}

					// Has Files
					if ( typeof libraries[key]['files'] !== "undefined") {

						// merge arrays
						var files = files.concat(libraries[key]['files']);

					}

				}

			}

			/*
			* Process JS
			*
			*/

			// Fix js paths
			for (var i = 0; i < js.length; i++) {

				js[i] = '../frontend' + js[i];

			}

			// fetch task's config object
			var uglify = grunt.config.get('uglify') || {};

			// add to config object
			uglify[frontend_folder_name + '_libraries_js'] = {

				// input
				src : js,

				// output
				dest : '../public/' + frontend_folder_name + '/libraries/libraries.js',

				// filter
				filter : 'isFile',

			};

			// save new config object to task
			grunt.config.set('uglify', uglify);

			/*
			* Process CSS
			*
			*/

			// Fix css paths
			for (var i = 0; i < css.length; i++) {

				css[i] = '../frontend' + css[i];

			}

			// fetch task's config object
			var cssmin = grunt.config.get('cssmin') || {
				options : {
					cleancss : true
				}
			};

			// add to config object
			cssmin[frontend_folder_name + '_libraries_css'] = {

				// input
				src : css,

				// output
				dest : '../public/' + frontend_folder_name + '/libraries/libraries.css',

				// filter
				filter : 'isFile',

			};

			// save new config object to task
			grunt.config.set('cssmin', cssmin);

			/*
			* Process Files
			*
			*/

			// Fix files paths
			for (var i = 0; i < files.length; i++) {

				files[i] = '../frontend' + files[i];

			}

			// Loop through files list
			for (var i = 0; i < files.length; i++) {

				// source path
				file_source = files[i];

				// source file/folder name
				var filename = file_source.match(/([^\/]*)\/*$/)[1];

				// fetch task's config object
				var copy = grunt.config.get('copy') || {};

				// copy folder
				if (filename.indexOf(".") === -1) {

					// add to config object
					copy[frontend_folder_name + '_libraries_files_' + i] = {

						expand : true,

						cwd : file_source,

						src : ['**'],

						dest : '../public/' + frontend_folder_name + '/libraries/' + filename,

						filter : 'isFile',

					};

				}

				// copy file
				else {

					// add to config object
					copy[frontend_folder_name + '_libraries_files_' + i] = {

						src : file_source,

						dest : '../public/' + frontend_folder_name + '/libraries/' + filename,

						filter : 'isFile',

					};

				}

				// save new config object to task
				grunt.config.set('copy', copy);

			}

			/*
			 * Cleanup variables
			 *
			 */
			js = null;
			css = null;
			files = null;

		});

		// Run tasks
		grunt.task.run('uglify');
		grunt.task.run('cssmin');
		grunt.task.run('copy');

	});

};
