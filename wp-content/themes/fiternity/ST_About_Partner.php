<?php 
/**********
Template Name: About partner
**********/
get_header(); 
$aboutSubPage = get_post($postId);
$partAboutArgs=array(
	'orderby' => 'post_date',
	'order'   => 'ASC',
	'post_type'=> 'client',
	'post_status'=>'publish',
	'numberposts'=>-1
);
$partnerAboutPages=get_posts($partAboutArgs);
$linkUrl = get_post_meta($aboutSubPage->ID, 'rl_link_url', true);
$linkHeading = get_post_meta($aboutSubPage->ID, 'link_heading', true);
$linkTarget = get_post_meta($aboutSubPage->ID, 'rl_link_target', true);
?>
<div class="partner-section">
  <div class="container">
    <div class="col-6 center-block">
      <div class="title">
        <span class="tile-menu"><?php echo $aboutSubPage->post_title; ?></span>
         <?php echo apply_filters('the_content',$aboutSubPage->post_content  ); ?>
      </div>
    </div>
    <div class="brand-slider">
    	<?php 
    	foreach ($partnerAboutPages as $partnerAboutPage) { 
  		$featImage = wp_get_attachment_url(get_post_thumbnail_id($partnerAboutPage->ID) );
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
<?php get_footer(); ?>
