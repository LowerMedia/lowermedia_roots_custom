<?php

// Custom functions


/*############################################################################################
#
#   CREATE BAND POST TYPE
#   //This function creates a custom post type of band
*/

add_action( 'init', 'create_post_type' );
function create_post_type() 
  {
  	register_post_type( 'website',
  		array(
  			'labels' => array(
  				'name' => __( 'Website' ),
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
  		/*'capability_type' => 'band',
		'capabilities' => array(
			'publish_posts' => 'publish_band',
			'edit_posts' => 'edit_band',
			'edit_others_posts' => 'edit_others_band',
			'delete_posts' => 'delete_band',
			'delete_others_posts' => 'delete_others_band',
			'read_private_posts' => 'read_private_band',
			'edit_post' => 'edit_band',
			'delete_post' => 'delete_band',
			'read_post' => 'read_band',
			'edit_page' => 'edit_band',
		),*/
  		'public' => true,
  		'has_archive' => true,
  		'supports'=> array('thumbnail','title','editor', 'custom-fields', 'excerpt', 'revisions'),
  		'rewrite' => array('slug' => 'website'),
  		)
  	);
  }
  