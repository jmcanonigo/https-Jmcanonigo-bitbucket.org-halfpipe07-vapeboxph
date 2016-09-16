module.exports = function(grunt){
    
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-cssc');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
		uglify: {
			my_target: {
                files: {
                    'assets/js/main.min.js' : ['src/js/*.js', 'src/custom.js'] //compresses and combine multiple js files
                } //files
            } //my_target
		},
		cssmin: {
			build: {
	            src: 'src/css/*.css',
	            dest: 'assets/css/style.min.css'
	        }, //build
			target: {
				files: [{
				  expand: true,
				  cwd: 'assets/css',
				  src: ['src/css/*.css'],
				  dest: 'assets/css',
				  ext: '.min.css'
				}]
		  	}
        }, //cssmin
		cssc: {
	        build: {
	           options: {
	            consolidateViaDeclarations: true,
	            consolidateViaSelectors:    true,
	            consolidateMediaQueries:    true
	          }
	        } //build
	    }, //cssc 
		watch: {
            options: { livereload: true }, // reloads browser on save
            scripts: {
                files: ['src/*.js'],
                tasks: ['uglify']
            }, //scripts
            css: {
                files: ['src/css/*.css'],
                tasks: ['cssc:build', 'cssmin:build']
            } //sass
        } //watch
    });


    grunt.registerTask('default', ['uglify','cssmin', 'cssc', 'watch']);

};