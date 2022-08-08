/*
 * AppUI Template
 * Gulp Automated Tasks
 */

// Paths to sources, raw files 
var srcPaths = {
	templates: 'templates/',
	sass: 'scss/',
	js: 'js/',
	img: 'img/',
	fonts: 'fonts/',
	data: './data/',
};


// Paths to production ready files
var destPaths = {
	site: '../dist/',
	css: 'assets/css/',
	js: 'assets/js/',
	img: 'assets/img/',
	fonts: 'assets/fonts/',
};


// Npm dependencies
var	gulp							= require( 'gulp' ),
		changed					= require( 'gulp-changed' ),
		data							= require( 'gulp-data' ),
		imagemin				= require( 'gulp-imagemin' ),
		sass							= require( 'gulp-sass' ),
		postcss					= require( 'gulp-postcss' ),
		sourcemaps			= require( 'gulp-sourcemaps' ),
		jsoncombine			= require( 'gulp-jsoncombine' ),
		concat						= require( 'gulp-concat' ),
		nunjucksRender		= require( 'gulp-nunjucks-api' ),
		prettify					= require( 'gulp-prettify' ),
		uglify						= require( 'gulp-uglify' ),
		autoprefixer			= require( 'autoprefixer' ),
		mergeStreams		= require( 'merge-stream' ),
		fs								= require( 'fs' );


// Copy icon fonts
function copyFonts() {
	return gulp.src( [ srcPaths.fonts + '*' ] )
		.pipe( changed( destPaths.site + destPaths.fonts ) )
		.pipe( gulp.dest( destPaths.site + destPaths.fonts ) )
}


// Minify images
function minifyImg() {
	return gulp.src( srcPaths.img + '**/*' )
		.pipe( changed( destPaths.site + destPaths.img ) )
		.pipe( imagemin({
			progressive: true,
		}) )
		.pipe( gulp.dest( destPaths.site + destPaths.img ) );
}


// Combine multiple json files in "data.json"
function combineJson() {
	return gulp.src( srcPaths.data + '**/!(data)*.json' )
		.pipe( jsoncombine( 'data.json', function( data ) {
			return new Buffer( JSON.stringify( data ) );
		}))
		.pipe( gulp.dest( srcPaths.data ) );
}


// Get data from combined "data.json" file
function getJsonData( file ) {
	return JSON.parse( fs.readFileSync( ( srcPaths.data + 'data.json' ) ) );
}


// Copy Js files
function compileJs() {
	var core = gulp.src([
			srcPaths.js + 'core/*.js'
		])
		.pipe( gulp.dest( destPaths.site + destPaths.js + 'core/' ) );

	var plugins = gulp.src([
			srcPaths.js + 'plugins/**/*.*'
		])
		.pipe( gulp.dest( destPaths.site + destPaths.js + 'plugins/' ) );

	var pages = gulp.src([
			srcPaths.js + 'pages/*.js'
		])
		.pipe( gulp.dest( destPaths.site + destPaths.js + 'pages/' ) );

	var app = gulp.src([
			srcPaths.js + 'app.js'
		])
		.pipe( gulp.dest( destPaths.site + destPaths.js ) );

	var appCustom = gulp.src([
			srcPaths.js + 'app-custom.js'
		])
		.pipe( gulp.dest( destPaths.site + destPaths.js ) );

	return mergeStreams( core, plugins, pages, app, appCustom );
}


// Compile Sass files
function compileSass() {
	var processors = [autoprefixer];
	gulp.src( srcPaths.sass + '**/*.scss' )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			outputStyle: 'expanded',
			sourceComments: false,
			indentType: 'tab',
			indentWidth: 1,
		}).on( 'error', sass.logError ) )
		.pipe( postcss( processors ) )
		.pipe( sourcemaps.write( 'maps' ) )
		.pipe( gulp.dest( destPaths.site + destPaths.css ) );
}


// Render Html files
function renderHtml() {
	return gulp.src( srcPaths.templates + '**/!(_)*.html' ) // Exclude rendering of the files named with starting underscore prefix (_)
		.pipe( data( getJsonData ) )
		.pipe( nunjucksRender({
			data: {
				path: '',
				css_path: destPaths.css,
				js_path: destPaths.js,
				img_path: destPaths.img,
			},
			src: srcPaths.templates,
			fs: fs
		}))
		.pipe( prettify({
			indent_size: 4,
			preserve_newlines: true,
		}))
		.pipe( gulp.dest( destPaths.site ) );
}


// Rerun tasks when a file changes
function watchChanges() {
	compileSass();
	renderHtml();
	gulp.watch( srcPaths.js + '**/*.js', ['js'] );
	gulp.watch( srcPaths.sass + '**/*.scss', ['sass'] );
	gulp.watch( srcPaths.templates + '**/*.html', ['html'] );
}


// Gulp tasks
gulp.task( 'fonts', copyFonts );
gulp.task( 'img', minifyImg );
gulp.task( 'json', combineJson );
gulp.task( 'js', compileJs );
gulp.task( 'sass', compileSass );
gulp.task( 'html', ['fonts', 'img', 'json', 'js'], renderHtml );
gulp.task( 'watch', ['fonts', 'img', 'json', 'js', 'sass'], watchChanges );
