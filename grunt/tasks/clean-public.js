/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-clean');

	var task_name = 'clean-public';
	var task_description = 'This task completely empties the production folder "/public" except for the initial index.php file.';

	// Task
	grunt.registerTask(task_name, task_description, function() {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// Config task
		var config = {

			// options
			options : {

				// allow deletion outside grunt folder
				force : true

			},

			// delete all public files/folders except index.php
			clean : ['../public/**/*', '!../public/index.php']

		};

		// set task config
		grunt.config.set('clean', config);

		// run tasks
		grunt.task.run('clean');

	});

};
