module.exports = function(grunt) {

  grunt.initConfig({
  pkg : grunt.file.readJSON('package.json'),


    php: {
      test: {
        options: {
          keepalive: true,
          open: true
          }
      }
    },

    less: {
      development: {
        options: {
          paths: ["styles/"]
        },
        files: {
          "styles/app.css": "styles/less/app.less",
        }
      }
    },

    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1
      },
      target: {
        files: {
          'dist/styles.min.css': [
            'styles/app.css',
          ],
        }
      }
    },

    uglify: {
      options: {
        beautify: true,
      },
      all: {
        files: {
          'dist/libs.min.js': [
            'bower_components/jquery/dist/jquery.min.js',
          ],
          'dist/scripts.min.js': [
            'scripts/app.js',
          ]
        }
      },
      scripts: {
        files: {
          'dist/scripts.min.js': [
            'scripts/app.js',
          ]
        }
      }
    },

    // Append a timestamp to JS and CSS files which are located in 'index.html'
    cachebreaker: {
      dev: {
        options: {
          match: [
            'dist/styles.min.css',
            'dist/libs.min.js',
            'dist/scripts.min.js',
          ],
        },
        files: {
          src: ['index.php', 'view/layouts/head.php', 'view/layouts/body.php']
        }
      }
    },

    watch: {
      options: {
        livereload: true,
      },
      less: {
        options: {
          livereload: false
        },
        files: ['app/styles/*.css', 'app/scripts/*.js', 'bootstrap-theme/**/*.css', 'styles/less/**/*.less'],
        tasks: ['less', 'cssmin', 'uglify:scripts', 'notify:watch', 'cachebreaker'],
      },
    },

    notify_hooks: {
      options: {
        enabled: true,
        max_jshint_notifications: 5, // maximum number of notifications from jshint output
        title: "Le Bus", // defaults to the name in package.json, or will use project directory's name
        success: false, // whether successful grunt executions should be notified automatically
        duration: 1 // the duration of notification in seconds, for `notify-send only
      }
    },

    notify: {
      watch: {
        options: {
          title: 'Watch Detected',
          message: 'LESS and minification finished.',
        }
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-cache-breaker');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-php');

  grunt.task.run('notify_hooks');

  grunt.registerTask('default', ['less', 'cssmin', 'uglify:scripts', 'cachebreaker', 'watch']);
  grunt.registerTask('server', ['less', 'cssmin', 'uglify:scripts', 'cachebreaker', 'php']);
  grunt.registerTask('build', ['less', 'cssmin', 'uglify:all', 'cachebreaker']);
};