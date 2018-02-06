<?php
// Plugin Name: DKUK Exhibitions
// Version: 1.0
// Author: Jacob Charles Wilson
// Author URI: https://jacobcharleswilson.com
// Adds Exhibition Custom Post Type
// https://generatewp.com/post-type/

function dkuk_exhibition_cpt() {

	$exhibition_labels = array(
		'name'                  => _x( 'Exhibitions', 'Post Type General Name', 'dkuk' ),
		'singular_name'         => _x( 'Exhibition', 'Post Type Singular Name', 'dkuk' ),
		'menu_name'             => __( 'Exhibitions', 'dkuk' ),
		'name_admin_bar'        => __( 'Exhibition', 'dkuk' ),
		'archives'              => __( 'Exhibition Archives', 'dkuk' ),
		'attributes'            => __( 'Exhibition Attributes', 'dkuk' ),
		'parent_item_colon'     => __( 'Parent Exhibition:', 'dkuk' ),
		'all_items'             => __( 'All Exhibitions', 'dkuk' ),
		'add_new_item'          => __( 'Add a new Exhibition', 'dkuk' ),
		'add_new'               => __( 'Add New', 'dkuk' ),
		'new_item'              => __( 'New Exhibition', 'dkuk' ),
		'edit_item'             => __( 'Edit Exhibition', 'dkuk' ),
		'update_item'           => __( 'Update Exhibition', 'dkuk' ),
		'view_item'             => __( 'View Exhibition', 'dkuk' ),
		'view_items'            => __( 'View Exhibitions', 'dkuk' ),
		'search_items'          => __( 'Search Exhibitions', 'dkuk' ),
		'not_found'             => __( 'Not found', 'dkuk' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'dkuk' ),
		'featured_image'        => __( 'Featured Image', 'dkuk' ),
		'set_featured_image'    => __( 'Set featured image', 'dkuk' ),
		'remove_featured_image' => __( 'Remove featured image', 'dkuk' ),
		'use_featured_image'    => __( 'Use as featured image', 'dkuk' ),
		'insert_into_item'      => __( 'Insert into exhibtion', 'dkuk' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Exhibition', 'dkuk' ),
		'items_list'            => __( 'Exhibitions list', 'dkuk' ),
		'items_list_navigation' => __( 'Exhibitons list navigation', 'dkuk' ),
		'filter_items_list'     => __( 'Filter exhibitions list', 'dkuk' ),
	);
	$exhibition_args = array(
		'label'                 => __( 'Exhibition', 'dkuk' ),
		'description'           => __( 'Used for exhibitions put on by DKUK', 'dkuk' ),
		'labels'                => $exhibition_labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-image',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'Exhibition', $exhibition_args );
}
add_action( 'init', 'dkuk_exhibition_cpt', 0 );

// Sets admin columns for Exhibitions
function dkuk_exhibition_custom_columns( $columns ) {
    $columns = array(
      'cb' => $columns['cb'],
	  'image' => __( 'Image' ),
	  'exhibition_title' => __( 'Exhibition' ),
	  'exhibition_organiser' => __( 'Organiser' ),
      'start_date' => __( 'Start Date' ),
	  'end_date' => __( 'End Date' ),
    );
  return $columns;
}
add_filter( 'manage_exhibition_posts_columns', 'dkuk_exhibition_custom_columns' );

// Adds data to Exhibition admin columns
function dkuk_exhibition_custom_columns_data( $column, $post_id ) {
  // Image column
	if ( 'image' === $column ) {
		echo get_the_post_thumbnail( $post_id, array(80, 80) );
	}

	if ( $column == 'start_date' ) {
		$start_date = get_field('start_date');

		if ( ! $start_date ) {
			_e( 'n/a' );
		} else {
			echo $start_date;
		}
	}

	if ( $column == 'end_date' ) {
		$end_date = get_field('end_date');

		if ( ! $end_date ) {
			_e( 'n/a' );
		} else {
			echo get_field('end_date');
		}
	}

	if ( $column == 'exhibition_title' ) {
		$exhibition_title = get_field('exhibition_title');

    	  if ( ! $exhibition_title ) {
    		  _e( 'n/a' );
    	  } else {
    		  echo edit_post_link($exhibition_title);
    	  }
    }

	if ( $column == 'exhibition_organiser' ) {
		$exhibition_organiser = get_field('exhibition_organiser');

		if ( ! $exhibition_organiser ) {
			_e( 'n/a' );
		} else {
			echo edit_post_link($exhibition_organiser);
		}
  	}
}
add_action( 'manage_exhibition_posts_custom_column', 'dkuk_exhibition_custom_columns_data', 10, 2);

// Reorder Exhibition type posts
// Always show them in reverse chronological order
// EVEN on the front end - so that the archive page is ordered correctly.
function dkuk_rev_chronological_exhibitions( $query ) {
	// only modify queries for 'event' post type
	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'exhibition' ) {
		$query->set('orderby', 'meta_value');
		$query->set('meta_key', 'start_date');
		$query->set('order', 'DESC');
	}
	// return
	return $query;
}
add_action('pre_get_posts', 'dkuk_rev_chronological_exhibitions');


?>
