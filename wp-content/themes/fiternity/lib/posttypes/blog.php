<?php add_action('init', 'create_blogs', 0);

function create_blogs() {
    $labels = array(
        'name' => _x('Blog', 'post type general name'),
        'singular_name' => _x('Blog', 'post type singular name'),
        'add_new' => _x('Add Blog', 'Blog'),
        'add_new_item' => __('Add Blog'),
        'edit_item' => __('Edit Blog'),
        'new_item' => __('New Blog'),
        'view_item' => __('View Blog'),
        'search_items' => __('Search Blog'),
        'not_found' => __('No Blog found'),
        'not_found_in_trash' => __('No Blog found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'blog/%blog_cat%','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'menu_icon'   => 'dashicons-welcome-write-blog',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('blog', $args);
    register_taxonomy("blog_cat", "blog", array("hierarchical" => true,
        "label" => "Blog Categories",
        "singular_label" => "Blog",
        'rewrite' => array('slug' => 'blog','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

    add_filter('post_link', 'blog_permalink', 1, 3);
    add_filter('post_type_link', 'blog_permalink', 1, 3);

   function blog_permalink($permalink, $post_id, $leavename)
   {
       //con %brand% catturo il rewrite del Custom Post Type
       if (strpos($permalink, '%blog_cat%') === FALSE) return $permalink;
       // Get post
       $post = get_post($post_id);
       if (!$post) return $permalink;
       $args_proj_cate = array('orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'all');
       // Get taxonomy terms
       $terms = wp_get_object_terms($post->ID, 'blog_cat',$args_proj_cate);
       $par_id = $post->post_parent;
       $terms_par = wp_get_object_terms($par_id, 'blog_cat',$args_proj_cate);
       if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
           $taxonomy_slug = $terms[0]->slug;
       else $taxonomy_slug = $terms_par[0]->slug;

       return str_replace('%blog_cat%', $taxonomy_slug, $permalink);
   }


}

?>
