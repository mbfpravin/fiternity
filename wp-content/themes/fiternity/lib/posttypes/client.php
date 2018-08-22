<?php //client post type
add_action('init', 'create_client', 0);

function create_client() {
    $labels = array(
        'name' => _x('Featured In', 'post type general name'),
        'singular_name' => _x('Featured In', 'post type singular name'),
        'add_new' => _x('Add Featured In', 'Event'),
        'add_new_item' => __('Add Featured In'),
        'edit_item' => __('Edit Featured In'),
        'new_item' => __('New Featured In'),
        'view_item' => __('View Featured In'),
        'search_items' => __('Search Featured In'),
        'not_found' => __('No Featured In found'),
        'not_found_in_trash' => __('No Featured In found in Trash'),
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
        'menu_icon'   => 'dashicons-art',
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
    );

    //Register the client post type.
    register_post_type('client', $args);
}