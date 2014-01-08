/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	var task_name = 'css';
	var task_description = 'This task minifies and moves all .css files for each frontend folder.';

	// Task
	grunt.registerTask(task_name, task_description, function() {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// loop through css files
		grunt.file.expand({
			filter : 'isFile'
		}, ['../app/styles/**/*.css', '!../app/styles/libraries/**']).forEach(function(dir) {

			// fetch task's config object
			var cssmin = grunt.config.get('cssmin') || {};

			// destination file
			var dest = dir.replace("../app", "../../public");

			// add to config object
			cssmin['css_' + dir] = {

				// input files
				src : dir,

				// output files
				dest : dest,

				// files only
				filter : 'isFile',

			};

			// save new config to object
			grunt.config.set('cssmin', cssmin);

		});

		// run tasks
		grunt.task.run('cssmin');

	});

};
