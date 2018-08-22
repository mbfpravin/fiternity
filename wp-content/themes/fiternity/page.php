<?php 
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
		<div class="col-8  generic-content">
			<h1><?php echo $post->post_title; ?></h1>
			   <?php echo wpautop(apply_filters('the_content',$post->post_content)); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
