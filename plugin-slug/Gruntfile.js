module.exports = function (grunt) {
	"use strict";

	// Project configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),

		addtextdomain: {
			options: {
				textdomain: "TEXT_DOMAIN",
			},
			update_all_domains: {
				options: {
					updateDomains: true,
				},
				src: [
					"*.php",
					"**/*.php",
					"!.git/**/*",
					"!bin/**/*",
					"!node_modules/**/*",
					"!tests/**/*",
				],
			},
		},

		wp_readme_to_markdown: {
			your_target: {
				files: {
					"README.md": "readme.txt",
				},
			},
		},

		makepot: {
			target: {
				options: {
					domainPath: "/languages",
					exclude: [".git/*", "bin/*", "node_modules/*", "tests/*"],
					mainFile: "plugin-slug.php",
					potFilename: "plugin-slug.pot",
					potHeaders: {
						poedit: true,
						"x-poedit-keywordslist": true,
					},
					type: "wp-plugin",
					updateTimestamp: true,
				},
			},
		},

		cssmin: {
			target: {
				files: [
					{
						expand: true,
						cwd: "assets/css",
						src: ["*.css", "!*.min.css"],
						dest: "assets/css",
						ext: ".min.css",
					},
				],
			},
		},

		uglify: {
			dev: {
				files: [
					{
						expand: true,
						src: ["assets/js/*.js", "!assets/js/*.min.js"],
						dest: "assets/js",
						cwd: ".",
						rename: function (dst, src) {
							return src.replace(".js", ".min.js");
						},
					},
				],
			},
		},

		watch: {
			scripts: {
				files: ["**/*.js", "**/*.css", "**/*.php"],
				tasks: ["addtextdomain", "makepot", "cssmin", "uglify"],
				options: {
					spawn: false,
				},
			},
		},
	});

	// Load tasks.
	grunt.loadNpmTasks("grunt-wp-i18n");
	grunt.loadNpmTasks("grunt-wp-readme-to-markdown");
	grunt.loadNpmTasks("grunt-contrib-watch");
	grunt.loadNpmTasks("grunt-contrib-cssmin");
	grunt.loadNpmTasks("grunt-contrib-uglify");

	// Register tasks.
	grunt.registerTask("default", ["i18n"]);
	grunt.registerTask("i18n", ["addtextdomain", "makepot"]);
	grunt.registerTask("readme", ["wp_readme_to_markdown"]);
	grunt.registerTask("minify", ["cssmin", "uglify"]);

	grunt.util.linefeed = "\n";
};
