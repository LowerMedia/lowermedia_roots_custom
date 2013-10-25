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
  

  /*############################################################################################
#
#   REGISTER WDIGETS
#   //This function registers home page widget 4
*/
function lowermedia_net_responsive_widgets_init() {
    register_sidebar( array(
		'name' => 'Social Media Icon Area',
		'id' => 'social_media_icon_holder',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action('widgets_init', 'lowermedia_net_responsive_widgets_init');

/*############################################################################################
#
#   ALLOW WIDGETS TO PROCESS SHORTCODES
#   
*/
add_filter('widget_text', 'do_shortcode');


/*############################################################################################
#
#   
#   
*/

add_action( 'add_meta_boxes', 'lowermedia_add_website_link_meta_boxes' );
/* Create one or more meta boxes to be displayed on the post editor screen. */
function lowermedia_add_website_link_meta_boxes() {

	add_meta_box(
		'lowermedia-website-link',			// Unique ID
		esc_html__( 'Vimeo Link', 'example' ),		// Title
		'lowermedia_website_link_meta_box',		// Callback function
		'session_video',					// Admin page (or post type)
		'side',					// Context
		'default'					// Priority
	);
}

/* Display the post meta box. */
function lowermedia_website_link_meta_box( $object, $box ) { 

	wp_nonce_field( basename( __FILE__ ), 'lowermedia_website_link_nonce' ); 
	
	?>
	<p>
		<label for="lowermedia-website-link"><?php _e( "Add Vimeo video extentsion number (at end of URL): http://vimeo.com/12345", 'example' ); ?></label>
		<br /><br />
		<input style='width:100px' class="widefat" type="text" name="lowermedia-website-link" id="lowermedia-website-link" value="<?php echo esc_attr( get_post_meta( $object->ID, 'lowermedia_website_link', true ) ); ?>" size="15" />
	</p>
<?php }

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'lowermedia_save_website_link_meta', 10, 2 );

/* Meta box setup function. */
function lowermedia_video_link_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'lowermedia_add_website_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'lowermedia_save_website_link_meta', 10, 2 );
}


/* Save the meta box's post metadata. */
function lowermedia_save_website_link_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['lowermedia_website_link_nonce'] ) || !wp_verify_nonce( $_POST['lowermedia_website_link_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	//$new_meta_value = 'http://vimeo.com/';
	$new_meta_value = ( isset( $_POST['lowermedia-website-link'] ) ? sanitize_html_class( $_POST['lowermedia-website-link'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'lowermedia_website_link';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}

/* Filter the post class hook with our custom post class function. */
add_filter( 'post_class', 'lowermedia_website_link' );
function lowermedia_website_link( $classes ) {

	/* Get the current post ID. */
	$post_id = get_the_ID();

	/* If we have a post ID, proceed. */
	if ( !empty( $post_id ) ) {

		/* Get the custom post class. */
		$post_class = get_post_meta( $post_id, 'lowermedia_website_link', true );

		/* If a post class was input, sanitize it and add it to the post class array. */
		if ( !empty( $post_class ) )
			$classes[] = sanitize_html_class( $post_class );
	}

	return $classes;
}