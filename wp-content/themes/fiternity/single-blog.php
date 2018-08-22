<?php 

get_header();
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$imageId = MultiPostThumbnails::get_post_thumbnail_id('blog', 'bannerimage', $post->ID);
$imageUrl = wp_get_attachment_url($imageId, NULL);
$defaultImage = get_option('default_image');
if($imageUrl!='') {
  $image = $imageUrl;
} else {
  $image = $defaultImage;
}
$link_name = get_post_meta($post->ID, 'link_name', true);
$link_url = get_post_meta($post->ID, 'link_url', true);
$link_target = get_post_meta($post->ID, 'link_target', true);

?>
<!-- <section class="subBanner">
	<div class="container">
		<div class="parallaxBg subBanner-bg" style="background-image: url(<?php echo $image; ?>);"></div>
	
		
	
	<?php 
	
	if($link_name!= "" && $link_url!='') { ?>
	    <div class="alignBtn">
	      <p>Image credit: <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" ><?php echo $link_name; ?></a></p>
	    </div>
    <?php } ?>

		</div>
	</section>	 -->
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
             <?php echo apply_filters('the_content',$post->post_content  ); ?>
         </div>
    </div>
</div>
<?php get_footer(); ?>