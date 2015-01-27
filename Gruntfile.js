'use strict';

module.exports = function(grunt) {

  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['bower_components/foundation/scss']
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'css/app.css': 'scss/app.scss'
        }
      }
    },
    clean: {
      theme: {
        src: ['degrona15', 'zip']
      }
    },
    copy: {
      theme: {
        files: [{
          expand: true,
          cwd: 'assets/',
          src: '**/*.{png,jpg,jpeg,svg,eot,woff,ttf}',
          dest: 'degrona15/assets/'
        }, {
          expand: true,
          cwd: 'css/',
          src: '*.css',
          dest: 'degrona15/css/'
        }, {
          expand: true,
          cwd: 'js/',
          src: ['app.js', 'modernizr/modernizr.min.js', 'jquery/dist/jquery.min.js', 'rem-polyfill/rem.min.js'],
          dest: 'degrona15/js/'
        }, {
          expand: true,
          cwd: '.',
          src: '*.{txt,png,css}',
          dest: 'degrona15/'
        }, {
          expand: true,
          cwd: '.',
          src: ['**/*.php', 'languages/*'],
          dest: 'degrona15/'
        }]
      },
      scripts: {
        expand: true,
        cwd: 'bower_components/',
        src: '**/*.js',
        dest: 'js'
      },

      maps: {
        expand: true,
        cwd: 'bower_components/',
        src: '**/*.map',
        dest: 'js'
      }
    },
    uglify: {
      dist: {
        files: [{
          'js/modernizr/modernizr.min.js': ['js/modernizr/modernizr.js']
        }, {
          'js/custom/degrona15.min.js': ['js/custom/degrona15.js']
        }]
      }
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: [
          'js/foundation/js/foundation.min.js',
          'js/custom/*.min.js'
        ],

        dest: 'js/app.js'
      }

    },
    watch: {
      grunt: {
        files: ['Gruntfile.js']
      },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass']
      },
      concat: {
        files: 'js/custom/*.js',
        tasks: ['concat']
      }
    },
    zip: {
      theme: {
        dest: 'zip/degrona15.zip',
        src: 'degrona15/**'
      }
    }
  });

  grunt.registerTask('default', ['uglify', 'concat', 'copy:scripts', 'copy:maps', 'watch']);
  grunt.registerTask('build_theme', ['sass', 'copy:scripts', 'copy:maps', 'uglify', 'concat', 'clean:theme', 'copy:theme', 'zip:theme']);

}