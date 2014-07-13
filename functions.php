<?php
/**
 * Required by WordPress.
 *
 * Keep this file clean and only use it for requires.
 */

require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/htaccess.php');        // Rewrites for assets, H5BP .htaccess
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions


function lowermedia_add_sass_styles()  
{ 
  // Register the style like this for a theme:  
  // (First the unique name for the style (custom-style) then the src, 
  // then dependencies and ver no. and media type)
  wp_register_style( 'sass-screen-styles', get_template_directory_uri() . '/stylesheets/screen.css',  array(), '20130715', 'all' );
  // enqueing:
  wp_enqueue_style( 'sass-screen-styles' );
}
add_action('wp_enqueue_scripts', 'lowermedia_add_sass_styles', 100);

function lowermedia_add_favicon() {
	$favicon_url = get_stylesheet_directory_uri().'/favicon.ico';
	echo '<link rel="shortcut icon" href="'.$favicon_url .'" />';
}
add_action('admin_head', 'lowermedia_add_favicon');
add_action('wp_head', 'lowermedia_add_favicon');