/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-copy');

	var task_name = 'images';
	var task_description = 'This task copies over the "images" folders from each frontend folder to the "/public" folder.';

	// Task
	grunt.registerTask(task_name, task_description, function() {

		// Debug top info
		grunt.log.debug('Name: ' + task_name);
		grunt.log.debug('Description: ' + task_description);

		// looping through frontend folders (except libraries folder)
		grunt.file.expand(['../frontend/*', '!../frontend/libraries']).forEach(function(dir) {
			
			// frontend folder's name
			var frontend_folder_name = dir.match(/([^\/]*)\/*$/)[1];

			// fetch task's config object
			var copy = grunt.config.get('copy') || {};

			// add to config object
			copy[frontend_folder_name + '_images'] = {

				expand : true,
				
				cwd : '../frontend/'+frontend_folder_name+'/images/',
				
				src : '**/*.{png,jpg,svg,bmp,gif,apng,ico,jpeg,swf}',

				dest : '../public/' + frontend_folder_name + '/images/',

				filter : 'isFile',

			};
			
			// save new config object to task
			grunt.config.set('copy', copy);
			
		});

		// run tasks
		grunt.task.run('copy');

	});

};
