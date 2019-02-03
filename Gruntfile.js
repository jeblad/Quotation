/*jshint node:true */
module.exports = function ( grunt ) {
	grunt.loadNpmTasks( 'grunt-jsonlint' );
	grunt.loadNpmTasks( 'grunt-banana-checker' );
	grunt.loadNpmTasks( 'grunt-markdownlint' );
	grunt.loadNpmTasks( 'grunt-lintspaces' );

	grunt.initConfig( {
		lintspaces: {
			all: {
				src: [
					'*.js',
					'**/*.js',
					'**/*.css',
					'!node_modules/**',
					'!vendor/**'
				],
				options: {
					newline: true,
					newlineMaximum: 2,
					trailingspaces: true,
					indentation: 'tabs',
					ignores: [ 'js-comments' ]
				}
			},
			json: {
				src: [
					'.eslintrc',
					'.jscsrc',
					'.jshintrc',
					'*.json',
					'!node_modules/**',
					'!vendor/**'
				],
				options: {
					newlineMaximum: 2,
					trailingspaces: true,
					indentationGuess: true,
					ignores: [ 'js-comments' ]
				}
			},
			lua: {
				src: [
					'**/*.lua',
					'!node_modules/**',
					'!vendor/**'
				],
				options: {
					newline: true,
					newlineMaximum: 2,
					trailingspaces: true,
					indentation: 'tabs',
					ignores: [ /^\t*--/g ]
				}
			}
		},
		banana: {
			all: 'i18n/'
		},
		jsonlint: {
			all: [
				'**/*.json',
				'!node_modules/**',
				'!vendor/**'
			]
		}
	} );

	grunt.registerTask( 'lint', [ 'lintspaces', 'markdownlint' ] );
	grunt.registerTask( 'test', [ 'jsonlint', 'banana' ] );
	grunt.registerTask( 'default', [ 'lint', 'test' ] );
};
