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

		// loop through less files
		grunt.file.expand(['../app/styles/*', '!../app/styles/libraries/**']).forEach(function(dir) {

			var is_folder = grunt.file.isDir(dir);

			if (!is_folder) {
				return;
			}
			
			dir = dir + '/*.less';
			
			// loop through less files
			grunt.file.expand({
				filter : 'isFile'
			}, dir).forEach(function(dir) {

				// fetch task's config object
				var less = grunt.config.get('less') || {
					options : {
						cleancss : true
					}
				};

				// destination file
				var dest = dir.replace("../app", "../../public") + '.css';

				// add to config object
				less['less_' + dir] = {

					// input files
					src : dir,

					// output files
					dest : dest,

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
