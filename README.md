degrona15
=========

WordPress theme for the use of parliamentary election candidates (2015).

Primarily developed for Keski-Suomen Vihreät, but you may use it if you like.

## Technical details

 - child theme, based on [FoundationPress theme](https://github.com/olefredrik/foundationpress)
 - WordPress 4.0+

## Contributors
 - Ville Korhonen (@ypcs)
 - Janne Saarela (@0is1)

## Development

#### Clone degrona-ehdokas -plugin in /plugins-folder
```
git clone git@github.com:VihreatDeGrona/degrona-ehdokas.git
```

#### Install this stuff
* Node.js: Use the installer provided on the NodeJS website.
* Grunt: Run [sudo] npm install -g grunt-cli
* Bower: Run [sudo] npm install -g bower

#### After installing node, grunt and bower

* Install node_packages and bower_components
```
npm install && bower install
```
* Then just run:
```
grunt
```

#### Stylesheet Folder Structure (from FoundationPress)

* style.css: Do not worry about this file. (For some reason) it's required by WordPress. All styling are handled in the Sass files described below
* scss/app.scss: Sass imports for global config, foundation and site structure
* scss/config/_variables.scss: Your custom variables
* scss/config/_colors.scss: Your custom color scheme
* scss/config/_settings.scss: Original Foundation 5 base settings
* scss/site/_structure: Your custom site structure
* css/app.css: All Sass files are minified and compiled to this file

#### Script Folder Strucutre (from FoundationPress)

* bower_components/: This is the source folder where all Foundation scripts are located. foundation update will check and update scripts in this folder
* js/custom: This is where you put all your custom scripts. Every .js file you put in this directory will be minified and concatinated to app.js
* js/: jQuery, Modernizr and Foundation scripts are copied from bower_components/ to this directory, where they are minified and concatinated and enqueued in WordPress
* Please note that you must run grunt in your terminal for the scripts to be copied. See Gruntfile.js for details