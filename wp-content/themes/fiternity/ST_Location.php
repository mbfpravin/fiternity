<?php
/**********
Template Name: Location
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
<section class="subBanner">
	<div class="container">
		<div class="parallaxBg subBanner-bg" style="background-image: url(<?php echo $image; ?>);"></div>
	</div>
	
</section>
<div class="container">
	<div class="row">
		<div class="col-8 generic-content">
			<?php echo apply_filters('the_content',$post->post_content); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
