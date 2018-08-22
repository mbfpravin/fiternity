<?php //partner post type
add_action('init', 'create_partner', 0);

function create_partner() {
    $labels = array(
        'name' => _x('Partner', 'post type general name'),
        'singular_name' => _x('Partner', 'post type singular name'),
        'add_new' => _x('Add Partner', 'Event'),
        'add_new_item' => __('Add Partner'),
        'edit_item' => __('Edit Partner'),
        'new_item' => __('New Partner'),
        'view_item' => __('View Partner'),
        'search_items' => __('Search Partner'),
        'not_found' => __('No Partner found'),
        'not_found_in_trash' => __('No Partner found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'partner','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'menu_icon'   => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
    );

    //Register the partner post type.
    register_post_type('partner', $args);
}