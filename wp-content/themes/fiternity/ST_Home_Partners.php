<?php
/**********
Template Name: Home - Partners
**********/
global $postId;
$subPage = get_post($postId);
$partArgs=array(
	'orderby' => 'post_date',
	'order'   => 'ASC',
	'post_type'=> 'partner',
	'post_status'=>'publish',
	'numberposts'=>-1
);
$partnerPages=get_posts($partArgs);
$linkUrl = get_post_meta($subPage->ID, 'rl_link_url', true);
$linkHeading = get_post_meta($subPage->ID, 'link_heading', true);
$linkTarget = get_post_meta($subPage->ID, 'rl_link_target', true);
?>
<div class="partner-section">
  <div class="container">
    <div class="col-6 center-block">
      <div class="title">
        <span class="tile-menu"><?php echo $subPage->post_title; ?></span>
        <?php echo apply_filters('the_content',$subPage->post_content); ?>
      </div>
    </div>
    <div class="brand-slider">
    	<?php 
    	foreach ($partnerPages as $partnerPage) { 
  		$featImage = wp_get_attachment_url(get_post_thumbnail_id($partnerPage->ID) );
    	?>
	      <div>
	        <img src="<?php echo $featImage; ?>" alt="images">
	      </div>
	      <?php } ?>
   	</div>
   	<?php if($linkHeading != "" && $linkUrl!='') { ?>
	    <div class="alignBtn">
	      <a href="<?php echo $linkUrl; ?>" target="<?php echo $linkTarget; ?>" class="button"><?php echo $linkHeading; ?></a>
	    </div>
    <?php } ?>
  </div>
</div>