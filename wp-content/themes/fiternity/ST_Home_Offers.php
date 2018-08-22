<?php
/**********
Template Name: Home - Offers
**********/
global $postId;
$subPage = get_post($postId);
$offerArgs=array(
	'orderby' => 'post_date',
	'order'   => 'ASC',
	'post_type'=> 'offer',
	'post_status'=>'publish',
	'numberposts'=>-1
);
$offerPages=get_posts($offerArgs); 
?>

<div class="nav-slider tab-content" id="tab-3">
	
   
	<div class="container">
		   
		<div class="nav-slider-wrap">
			<a target="_blank" href="https://itunes.apple.com/us/app/fiternity/id1142578504?ls=1&mt=8">
		  	<div class="image-slider extend-section">
				<?php 
				foreach ($offerPages as $offerPage) {
					$featImage = wp_get_attachment_url(get_post_thumbnail_id($offerPage->ID) ); ?>
					<div class="tabBg" style="background-image: url('<?php echo $featImage; ?>');"></div>
				<?php } ?>
		  	</div></a>
			<div class="slider-nav-tab">
				<?php foreach ($offerPages as $offerPage) { ?>
					<div class="tab">
						<a target="_blank" href="https://itunes.apple.com/us/app/fiternity/id1142578504?ls=1&mt=8">
						 <div class="main-tab">
					  <span><?php echo $offerPage->post_title; ?></span>
					  <?php echo apply_filters('the_content',$offerPage->post_content); ?>
					</div></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>