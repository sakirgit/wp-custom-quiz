<?php 


if ( ! function_exists('cpt_quiz') ) {

// Register Custom Post Type
function cpt_quiz() {

	$labels = array(
		'name'                  => _x( 'Quiz Items', 'Post Type General Name', 'cptq' ),
		'singular_name'         => _x( 'Post Type Quiz', 'Post Type Singular Name', 'cptq' ),
		'menu_name'             => __( 'QUIZ', 'cptq' ),
		'name_admin_bar'        => __( 'Quiz Item', 'cptq' ),
		'archives'              => __( 'Item Archives', 'cptq' ),
		'attributes'            => __( 'Item Attributes', 'cptq' ),
		'parent_item_colon'     => __( 'Parent Item:', 'cptq' ),
		'all_items'             => __( 'All Items', 'cptq' ),
		'add_new_item'          => __( 'Add New Item', 'cptq' ),
		'add_new'               => __( 'Add New', 'cptq' ),
		'new_item'              => __( 'New Item', 'cptq' ),
		'edit_item'             => __( 'Edit Item', 'cptq' ),
		'update_item'           => __( 'Update Item', 'cptq' ),
		'view_item'             => __( 'View Item', 'cptq' ),
		'view_items'            => __( 'View Items', 'cptq' ),
		'search_items'          => __( 'Search Item', 'cptq' ),
		'not_found'             => __( 'Not found', 'cptq' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'cptq' ),
		'featured_image'        => __( 'Featured Image', 'cptq' ),
		'set_featured_image'    => __( 'Set featured image', 'cptq' ),
		'remove_featured_image' => __( 'Remove featured image', 'cptq' ),
		'use_featured_image'    => __( 'Use as featured image', 'cptq' ),
		'insert_into_item'      => __( 'Insert into item', 'cptq' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'cptq' ),
		'items_list'            => __( 'Items list', 'cptq' ),
		'items_list_navigation' => __( 'Items list navigation', 'cptq' ),
		'filter_items_list'     => __( 'Filter items list', 'cptq' ),
	);
	$args = array(
		'label'                 => __( 'Post Type Quiz', 'cptq' ),
		'description'           => __( 'Post Type Description', 'cptq' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'menu_icon' => plugin_dir_url( __FILE__ ).'images/Beyond-Culture-Logo-20.png',
	);
	register_post_type( 'post_type_quiz', $args );

}
add_action( 'init', 'cpt_quiz', 0 );

}


