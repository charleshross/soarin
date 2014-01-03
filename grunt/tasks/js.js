/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-uglify');

	var task_name = 'js';
	var task_description = 'This task minifies and moves all .js files for each frontend folder.';

	// Task
	grunt.registerTask(task_name, task_description, function() {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// looping through frontend folders (except libraries folder)
		grunt.file.expand(['../frontend/*', '!../frontend/libraries']).forEach(function(dir) {
			
			// frontend folder's name
			var frontend_folder_name = dir.match(/([^\/]*)\/*$/)[1];

			// looping through js files
			grunt.file.expand({
				filter : 'isFile'
			}, '../frontend/' + frontend_folder_name + '/js/**/*.js').forEach(function(dir) {
				
				// fetch task's config object
				var uglify = grunt.config.get('uglify') || {};
				
				var file_source = dir;
				
				var file_destination = file_source.replace("frontend", "public");
				
				// add to config object
				uglify[frontend_folder_name + '_js_' + dir] = {

					// input files
					src : file_source,

					// output files
					dest : file_destination,

					// files only
					filter : 'isFile',

				};
				
				// save new config to object
				grunt.config.set('uglify', uglify);

			});

		});

		// run tasks
		grunt.task.run('uglify');

	});

};
