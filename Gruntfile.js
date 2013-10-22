module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concat: {
        options: {
        // define a string to put between each file in the concatenated output
        separator: ';'
      },

      dist: {
        // the files to concatenate
        src: ['js/assets/*.js'],
        // the location of the resulting JS file
        dest: 'js/dist/<%= pkg.name %>.<%= pkg.version %>.js'
      }
    },
    
    uglify: {
      my_target: {
        files: {
          'js/<%= pkg.name %>.<%= pkg.version %>.min.js': ['js/dist/<%= pkg.name %>.<%= pkg.version %>.js']
        }
      }
    },

    imagemin: {                          // Task
      dist: {                            // Target
        options: {                       // Target options
          optimizationLevel: 3
        },
            files: [{
                expand: true,
                cwd: 'images/uncompressed/',
                src: '{,*/}*.{png,jpg,jpeg}',
                dest: 'images/compressed'
            }]
      }
    },

    coffee: {
      compile: {
        files: {
          'js/coffee-compiled/main.js': 'coffee/*.coffee'
        }
      },  
    },

    compass: {
      dist: {
        options: {
          cssDir: './',
          httpPath: '/',
          sassDir: 'sass',
          fontsDir: 'fonts',
          imagesDir: 'images/compressed',
          javascriptsDir: 'js',
          outputStyle: 'compressed',
          relativeAssets: true,
          lineComments: false
        }
      }
    },

    clean: {
      build: {
        src: ["js", "images/compressed", "style.css"]
      }
    },

    watch: {
      compass: {
        // We watch and compile sass files as normal but don't live reload here
        files: ['sass/*.scss'],
        tasks: ['compass'],
      },

      scripts: {
        // We watch and compile sass files as normal but don't live reload here
        files: ['js/assets/*.js', 'coffee/*.coffee'],
        tasks: ['coffee', 'concat', 'uglify'],
      },

      livereload: {
        // Here we watch the files the sass task will compile to
        // These files are sent to the live reload server after sass compiles to them
        options: { livereload: true },
        files: ['dest/**/*'],
      },
    },
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-livereload');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-clean');

  // Default task(s).
  grunt.registerTask('default', ['coffee', 'concat', 'uglify', 'compass', 'imagemin']);

};