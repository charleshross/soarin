/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-copy');

	var task_name = 'images';
	var task_description = 'This task copies over any images found in app/styles folder to public/styles';

	// Task
	grunt.registerTask(task_name, task_description, function() {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// looping through frontend folders (except libraries folder)
		grunt.file.expand(['../app/styles/*', '!../app/styles/libraries/**']).forEach(function(dir) {
			
			var folder = dir.match(/([^\/]*)\/*$/)[1];

			// fetch task's config object
			var copy = grunt.config.get('copy') || {};

			// add to config object
			copy['images'] = {

				expand : true,
				
				cwd : '../app/styles/',
				
				src : '**/*.{png,jpg,svg,bmp,gif,apng,ico,jpeg,swf}',

				dest : '../../public/styles',

				filter : 'isFile',

			};
			
			// save new config object to task
			grunt.config.set('copy', copy);
			
		});

		// run tasks
		grunt.task.run('copy');

	});

};
