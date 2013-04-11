<?php

// Custom functions


/*############################################################################################
#
#   CREATE WEBSITE CUSTOM POST TYPE
#   //This function creates a custom post type of website
*/

add_action( 'init', 'create_post_type' );
function create_post_type() 
  {
  	register_post_type( 'lowermedia_website',
  		array(
  			'labels' => array(
  				'name' => __( 'Websites' ),
  				'singular_name' => __( 'Website' ),
  				'add_new' => __( 'Add Website' ),
	            'all_items' => __( 'All Websites' ),
	            'add_new_item' => __( 'Add Website' ),
	            'edit_item' => __( 'Edit Website' ),
	            'new_item' => __( 'New Website' ),
	            'view_item' => __( 'View Website' ),
	            'search_items' => __( 'Search Websites' ),
	            'not_found' => __( 'No websites found' ),
	            'not_found_in_trash' => __( 'No websites found in trash' ),
	            'parent_item_colon' => __( 'Parent Website' )
	            //'menu_name' => default to 'name'
  			),
  		/*'capability_type' => 'website',
		'capabilities' => array(
			'publish_posts' => 'publish_website',
			'edit_posts' => 'edit_website',
			'edit_others_posts' => 'edit_others_website',
			'delete_posts' => 'delete_website',
			'delete_others_posts' => 'delete_others_website',
			'read_private_posts' => 'read_private_website',
			'edit_post' => 'edit_website',
			'delete_post' => 'delete_website',
			'read_post' => 'read_website',
			'edit_page' => 'edit_website',
		),*/
  		'public' => true,
  		'has_archive' => true,
  		'supports'=> array('thumbnail','title','editor', 'custom-fields', 'excerpt', 'revisions'),
  		'rewrite' => array('slug' => 'websites'),
  		)
  	);
  }
  