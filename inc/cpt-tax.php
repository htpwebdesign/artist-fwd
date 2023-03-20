<?php


function artist_fwd_register_custom_post_types(){
       $labels = array(
        'name'               => _x( 'Services', 'post type general name' ),
        'singular_name'      => _x( 'Service', 'post type singular name'),
        'menu_name'          => _x( 'Services', 'admin menu' ),
        'name_admin_bar'     => _x( 'Service', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'service' ),
        'add_new_item'       => __( 'Add New Service' ),
        'new_item'           => __( 'New Service' ),
        'edit_item'          => __( 'Edit Service' ),
        'view_item'          => __( 'View Service' ),
        'all_items'          => __( 'All Services' ),
        'search_items'       => __( 'Search Services' ),
        'parent_item_colon'  => __( 'Parent Services:' ),
        'not_found'          => __( 'No Services found.' ),
        'not_found_in_trash' => __( 'No Services found in Trash.' ),
        'archives'           => __( 'Service Archives'),
        'insert_into_item'   => __( 'Insert into Service'),
        'uploaded_to_this_item' => __( 'Uploaded to this Service'),
        'filter_item_list'   => __( 'Filter Services list'),
        'items_list_navigation' => __( 'Services list navigation'),
        'items_list'         => __( 'Services list'),
        'featured_image'     => __( 'Service featured image'),
        'set_featured_image' => __( 'Set Service featured image'),
        'remove_featured_image' => __( 'Remove Service featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );


     $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'our-services' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'thumbnail' ),
    );
    register_post_type( 'artist-services', $args );


        $labels = array(
        'name'               => _x( 'Events', 'post type general name' ),
        'singular_name'      => _x( 'Event', 'post type singular name'),
        'menu_name'          => _x( 'Events', 'admin menu' ),
        'name_admin_bar'     => _x( 'Event', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Event' ),
        'add_new_item'       => __( 'Add New Event' ),
        'new_item'           => __( 'New Event' ),
        'edit_item'          => __( 'Edit Event' ),
        'view_item'          => __( 'View Event' ),
        'all_items'          => __( 'All Events' ),
        'search_items'       => __( 'Search Events' ),
        'parent_item_colon'  => __( 'Parent Events:' ),
        'not_found'          => __( 'No Events found.' ),
        'not_found_in_trash' => __( 'No Events found in Trash.' ),
        'archives'           => __( 'Event Archives'),
        'insert_into_item'   => __( 'Insert into Event'),
        'uploaded_to_this_item' => __( 'Uploaded to this Event'),
        'filter_item_list'   => __( 'Filter Events list'),
        'items_list_navigation' => __( 'Events list navigation'),
        'items_list'         => __( 'Events list'),
        'featured_image'     => __( 'Event featured image'),
        'set_featured_image' => __( 'Set Event featured image'),
        'remove_featured_image' => __( 'Remove Event featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    
     $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'artist-events' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title' ),
     );
    register_post_type( 'artist-events', $args );  


}

add_action( 'init', 'artist_fwd_register_custom_post_types' );

function fwd_rewrite_flush() {
    artist_fwd_register_custom_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fwd_rewrite_flush' );