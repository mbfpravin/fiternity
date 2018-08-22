<?php //client post type
add_action('init', 'create_offer', 0);

function create_offer() {
    $labels = array(
        'name' => _x('Offers', 'post type general name'),
        'singular_name' => _x('Offers', 'post type singular name'),
        'add_new' => _x('Add Offers', 'Event'),
        'add_new_item' => __('Add Offers'),
        'edit_item' => __('Edit Offers'),
        'new_item' => __('New Offers'),
        'view_item' => __('View Offers'),
        'search_items' => __('Search Offers'),
        'not_found' => __('No Offers found'),
        'not_found_in_trash' => __('No Offers found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'client','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'menu_icon'   => 'dashicons-tickets-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
    );

    //Register the client post type.
    register_post_type('offer', $args);
}