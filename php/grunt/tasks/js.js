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

		// loop through js files
		grunt.file.expand({
			filter : 'isFile'
		}, ['../app/styles/**/*.js', '!../app/styles/libraries/**']).forEach(function(dir) {
			
			// fetch task's config object
			var uglify = grunt.config.get('uglify') || {};

			// destination file
			var dest = dir.replace("../app", "../../public");
			
			// add to config object
			uglify['js_' + dir] = {

				// input files
				src : dir,

				// output files
				dest : dest,

				// files only
				filter : 'isFile',

			};

			// save new config to object
			grunt.config.set('uglify', uglify);

		});

		// run tasks
		grunt.task.run('uglify');

	});

};
