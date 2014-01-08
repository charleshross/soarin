/* jshint node: true */

// Gruntfile
module.exports = function(grunt) {

	// Dependencies
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-closure-compiler');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-dart2js');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');

	// Configuration
	grunt.initConfig({

		// Read package.json file
		pkg : grunt.file.readJSON('package.json'),

	});

	// Load external tasks from folder
	grunt.loadTasks("./tasks");

	// Default tasks
	grunt.registerTask('default', ['clean-public', 'libraries', 'images', 'less-to-css', 'css', 'js']);

}; 