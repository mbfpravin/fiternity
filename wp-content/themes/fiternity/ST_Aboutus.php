<?php 
/**********
Template Name: About us
**********/
get_header(); 
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$defaultImage = get_option('default_image');
if($featImage!='') {
  $image = $featImage;
} else {
  $image = $defaultImage;
}
?>
<div class="container">
	<div class="bread-crumb">
		<div class="container">
			
				<ul class="clearfix">
		<?php
		if (function_exists('bcn_display')) {
			bcn_display();
		}
		?>
			</ul>
		</div>
	</div>
	<div class="row">
		<?php 
		// var_dump($post->post_content);
		echo do_shortcode($post->post_content);
		 ?>
	</div>
	

</div>
<?php
$subPageArgs = array( 
	   'post_parent'   => $post->ID,
	   'post_type'     => 'page', 
	   'order'         => 'ASC', 
	   'orderby'       => 'menu_order',
	   'post_status'   => 'publish',
	   'numberposts'=>-1 
	); 
	$subPages = get_posts($subPageArgs);
	if (is_array($subPages) && count($subPages)>0) { 
	   	foreach ($subPages as $subPage) {
		   $postId = $subPage->ID;
		   $pageTemplate = get_post_meta($postId, '_wp_page_template', true);
		   $getTempPath = TEMPLATEPATH .'/'. $pageTemplate;
		   include TEMPLATEPATH .'/'. $pageTemplate;
	   	}
	} ?>
<?php get_footer(); ?>
