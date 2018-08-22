<?php
global $_POST;
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0].'wp-load.php';
$taxonomy = "blog_cat";
$noOfPost = 6;
$categoryId = $_POST['categoryId'];
$categoryName = $_POST['categoryName'];
$excludePostArray = $_POST['postIdArray'];
$blogArgs = array(
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => 'blog',
    'post_status'      => 'publish', 
     'post__not_in' => $excludePostArray,
    'numberposts'      => $noOfPost,
     'tax_query'  => array(
          array(
            'taxonomy'  => 'blog_cat',
            'field'   => 'term_id',
            'terms'   => $categoryId
          ) 
        )
);
$blogCollections = get_posts($blogArgs);
foreach ($blogCollections as $blogCollection) {
  // if(!in_array($servicePost->ID,$exclud0ePostArray)) {
    $featImage = wp_get_attachment_url(get_post_thumbnail_id($blogCollection->ID) );
    $imageId = MultiPostThumbnails::get_post_thumbnail_id('blog', 'blogicon', $blogCollection->ID);
    $imageUrl = wp_get_attachment_url($imageId, NULL);
    echo    '<div class="slider-blk col-4 '.$categoryId.' blog_col" data-id="'.$blogCollection->ID.'">
              <a href="'.get_permalink($blogCollection->ID).'" ">
                      <img src="'.$imageUrl.'" alt="slider">
                      
                        <div class="whitebox">
                      <span class="post-date"><strong>'. get_the_date( "F jS", $blogCollection->ID).'
                          </strong>'.get_the_date( "Y", $blogCollection->ID).'</span>
                        <h3><span class="newtag">'.$categoryName.'</span></h3>
                        <h4>'.$blogCollection->post_title.'</h4>
                      </div></a>
             </div>';
  // }
}
?>