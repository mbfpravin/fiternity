<?php 
get_header();
global $EM_Event;
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$imageId = MultiPostThumbnails::get_post_thumbnail_id('event', 'bannerimage', $post->ID);
$imageUrl = wp_get_attachment_url($imageId, NULL);
$defaultImage = get_option('default_image');
if($imageUrl!='') {
  $image = $imageUrl;
} else {
  $image = $defaultImage;
}
$content = str_replace("<p></p>","",$post->post_content);
$link_name = get_post_meta($post->ID, 'link_name', true);
$link_url = get_post_meta($post->ID, 'link_url', true);
$link_target = get_post_meta($post->ID, 'link_target', true);

?>

<?php
$category = get_the_terms( $post->ID, 'event-categories' );
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
		<div class="col-8 generic-content">
			<!-- <span class="infotag"><?php echo get_post_type(); ?>s</span> -->
			<h1><?php echo $post->post_title; ?></h1>
			<h3><?php echo $category[0]->name; ?></h3>
			<?php echo apply_filters('the_content',$content); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>