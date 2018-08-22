<?php 
get_header('sub'); 
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
		<div class="parallaxBg subBanner-bg" style="background-image: url(<?php echo $image; ?>);">
			<img src="<?php echo $image; ?>" alt="<?php echo $post->post_title; ?>">
		</div>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-8 generic-content">
			<p>It seems that the page you were trying to reach is not part of our website, or maybe it has just been removed.</p>
		</div>
	</div>
</div>
<?php get_footer(); ?>