module.exports = function (grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        run: {
            nightwatch: {
                exec: 'nightwatch'
            }
        },
        jshint: {
            options: {
                jshintrc: './.jshintrc',
                reporterOutput: ""
            },
            dist: ['js/millery.js']
        },
        uglify: {
            options: {
                sourceMap: true
            },
            build: {
                src: ['js/millery.js'],
                dest: 'build/js/millery.min.js'
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'build/css/millery.min.css': 'css/millery.scss'
                }
            }
        },
        postcss: {
            options: {
                processors: [
                    require("autoprefixer")({ browsers: ["last 3 versions", "ie > 9", "> 1%"] })
                ]
            },
            files: {
                expand: true,
                cwd: "build/css/",
                dest: "build/css/",
                src: ["millery.min.css"]
            }
        },
        watch: {
            scripts: {
                files: ['js/millery.js'],
                tasks: ['jshint', 'uglify']
            },
            styles: {
                files: ['css/*.scss'],
                tasks: ['sass', 'postcss']
            },
            docs: {
                files: ['readme.md', 'docs/includes/template.html'],
                tasks: 'markdown'
            }
        },
        markdown: {
            all: {
                files: [{
                    expand: true,
                    src: 'readme.md',
                    dest: 'docs/',
                    ext: '.html'
                }],
                options: {
                    template: 'docs/includes/template.html',
                    autoTemplate: true,
                    autoTemplateFormat: 'html'
                }
            }
        },
        compress: {
            main: {
                options: {
                    archive: 'output/millery.zip'
                },
                files: [{
                    src: ['css/**'],
                    dest: '/',
                }, {
                    src: ['build/**'],
                    dest: '/'
                }, {
                    src: ['js/**'],
                    dest: '/'
                }, {
                    src: ['docs/**', '!docs/includes/back.jpg', '!docs/includes/icons/**'],
                    dest: '/'
                }, {
                    src: ['tests/**', '!tests/coverage/**', '!tests/reports/**'],
                    dest: '/'
                }, {
                    src: ['Gruntfile.js', '.jshintrc', 'package.json', 'readme.md', 'CHANGELOG'],
                    dest: '/'
                },]
            },
            screenshots: {
                options: {
                    archive: 'output/screenshots.zip'
                },
                files: [{
                    expand: true,
                    cwd: 'toolbox/screenshots/',
                    src: ['*.png', '!inline.png', '!thumbnail.png'],
                    dest: '/'
                }]
            },
        },
        copy: {
            main: {
                expand: true,
                cwd: 'toolbox',
                src: ['inline.png', 'thumbnail.png'],
                dest: 'output/',
            },
        },
        browserSync: {
            dev: {
                bsFiles: {
                    src: [
                        'build/css/*.min.css',
                        'build/js/*.min.js',
                        'build/vendor/*.min.js'
                    ]
                },
                options: {
                    watchTask: true,
                    server: {
                        baseDir: "./"
                    },
                    startPath: "docs/single-test.html"
                }
            },
            docs: {
                bsFiles: {
                    src: [
                        'build/css/*.min.css',
                        'build/js/*.min.js',
                        'build/vendor/*.min.js',
                        'docs/**/*.css',
                        'docs/**/*.js',
                        'docs/readme.html',
                        'docs/**/*.png'
                    ]
                },
                options: {
                    watchTask: true,
                    server: {
                        baseDir: "./"
                    },
                    reloadDebounce: 1000,
                    startPath: "docs/readme.html",
                    notify: true
                }
            },
            test: {
                bsFiles: {
                    src: [
                        'tests/*.test.js',
                        'tests/output/millery.html'
                    ]
                },
                options: {
                    watchTask: true,
                    online: false,
                    server: {
                        baseDir: "./"
                    },
                    startPath: "tests/output/millery.html",
                    notify: false
                }
            },
            browsertest: {
                bsFiles: {
                    src: [
                        'tests/output/millery.html'
                    ]
                },
                options: {
                    watchTask: false,
                    online: false,
                    browser: ["chrome", "firefox", "internet explorer"],
                    server: {
                        baseDir: "./"
                    },
                    startPath: "tests/output/millery.html",
                    notify: false,
                    codeSync: false
                }
            }
        },
        karma: {
            test: {
                options: {
                    files: ['build/vendor/jquery.min.js', 'js/millery.js', 'tests/millery.test.js'],
                    basePath: '',
                    frameworks: ['jasmine'],
                    reporters: ['progress', 'code', 'coverage'],
                    preprocessors: { 'js/millery.js': 'coverage' },
                    port: 9876,
                    colors: true,
                    //loggers: [{type: 'console'}],
                    autoWatch: true,
                    browsers: ['Chrome', 'ChromeMobile'],
                    singleRun: true,
                    customLaunchers: {
                        ChromeMobile: {
                            base: 'Chrome',
                            flags: ['--window-size=414,736', '--use-mobile-user-agent', '--user-agent="Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36"']
                        }
                    },
                    htmlReporter: {
                        outputFile: 'tests/output/millery.html',
                        pageTitle: 'millery Behaviour Tests',
                        groupSuites: true,
                        useCompactStyle: true,
                        useLegacyStyle: true
                    },
                    codeReporter: {
                        outputPath: 'tests/code',
                        testFiles: ['tests/*.test.js'],
                        cssFiles: ['build/css/millery.min.css']
                    },
                    coverageReporter: {
                        type : 'html',
                        dir : 'tests/coverage/'
                    }
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-karma');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-markdown');
    grunt.loadNpmTasks('grunt-run');

    grunt.registerTask('min', ['jshint', 'uglify', 'sass', 'postcss', 'markdown', 'compress', 'copy']);
    grunt.registerTask('default', ['jshint', 'uglify', 'sass', 'postcss', 'markdown', 'compress', 'copy', 'karma', 'run:nightwatch']);
    grunt.registerTask('watcher', ['browserSync:dev', 'watch']);
    grunt.registerTask('watchdocs', ['browserSync:docs', 'watch']);
    grunt.registerTask('test', ['browserSync:test', 'watch:test']);
    grunt.registerTask('testbrowsers', ['browserSync:browsertest']);
};