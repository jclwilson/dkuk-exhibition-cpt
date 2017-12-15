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
		'add_new_item'          => __( 'Add New Exhibition', 'dkuk' ),
		'add_new'               => __( 'Add New', 'dkuk' ),
		'new_item'              => __( 'New Exhibition', 'dkuk' ),
		'edit_item'             => __( 'Edit Exhibition', 'dkuk' ),
		'update_item'           => __( 'Update Exhibition', 'dkuk' ),
		'view_item'             => __( 'View Exhibition', 'dkuk' ),
		'view_items'            => __( 'View Exhibitions', 'dkuk' ),
		'search_items'          => __( 'Search Exhibition', 'dkuk' ),
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

?>
