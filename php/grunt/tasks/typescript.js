/* jshint node: true */

// Gruntfile
module.exports = function (grunt) {

	// Dependencies
	grunt.loadNpmTasks("grunt-ts");

	var task_name = 'typescript';
	var task_description = 'Typescript compiler.';

	// Task
	grunt.registerTask(task_name, task_description, function () {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// fetch task's config object
		var ts = grunt.config.get('ts') || {
			options: {
				sourceMap: false,
				removeComments: true,
			}
		};

		// add to config object
		ts['main'] = {
			src: ['../app/styles/typescript/**/*.ts'],
			out: '../app/styles/typescript/main.js'
		};

		// save new config to object
		grunt.config.set('ts', ts);


		// run tasks
		grunt.task.run('ts');

	});

};
