/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-less');

	var task_name = 'less-to-css';
	var task_description = 'This task compiles all .less files to .css files for each frontend folder.';

	// Task
	grunt.registerTask(task_name, task_description, function() {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// looping through frontend folders (except libraries folder)
		grunt.file.expand(['../frontend/*', '!../frontend/libraries']).forEach(function(dir) {

			// frontend folder's name
			var frontend_folder_name = dir.match(/([^\/]*)\/*$/)[1];

			// looping through less files
			grunt.file.expand({
				filter : 'isFile'
			}, '../frontend/' + frontend_folder_name + '/less/*.less').forEach(function(dir) {
				
				// fetch task's config object
				var less = grunt.config.get('less') || {
					options : {
						cleancss : true
					}
				};
				
				var file_source = dir;
				
				var file_destination = file_source.replace("frontend", "public") + '.css';
				file_destination = file_source.replace("/less/", "/css/") + '.css';
				
				// add to config object
				less[frontend_folder_name + '_less_' + dir] = {

					// input files
					src : file_source,

					// output files
					dest : file_destination,

					// files only
					filter : 'isFile',

				};
				
				// save new config to object
				grunt.config.set('less', less);

			});

		});

		// run tasks
		grunt.task.run('less');

	});

};
