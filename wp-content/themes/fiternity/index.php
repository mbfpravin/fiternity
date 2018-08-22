<?php
/**********
Template Name: Home
**********/
get_header();?>
<div class="banner-section">
  	<div class="container">
        <div class="row align-items-end banner-content">
          <div class="col-8 mobile-padding">
            <p><?php echo apply_filters('the_content',$post->post_content); ?><p>
          </div>
          <!-- <div class="col-4 text-right">
                                <?php if(get_option('app_store')!='') { ?>
									<div class="appstore">
										<a href="<?php echo get_option('app_store'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_url');?>/img/app-store.png" alt="<?php echo $post->post_title; ?>"></a>
									</div>
								<?php } ?>
          </div> -->
         </div>
     </div>
</div>
<div class="tabs-menu">
	<?php 
	$mobileMenus = get_menu('mobile_menu');
	?>
	<ul>
		<?php
			$i=1;
			foreach($mobileMenus as $mobileMenu) { 
				?>
                <?php 
 				if($mobileMenu->type=="taxonomy") {
                ?>
					<li><a href="#tab-2" class="<?php echo strtolower($mobileMenu->title); ?>"><?php echo $mobileMenu->title; ?></a></li>
 				<?php
 				} else { 
                   	if($mobileMenu->title=="Events") {
 					?>
						<li <?php if($i==1) { echo 'class="current"'; } ?>><a href="#tab-1" class="<?php echo strtolower($mobileMenu->title); ?>"><?php echo $mobileMenu->title; ?></a></li>
					<?php } else if($mobileMenu->title=="Offers") { ?>
 						<li><a href="#tab-3" class="<?php echo strtolower($mobileMenu->title); ?>"><?php echo $mobileMenu->title; ?></a></li>
				    <?php
					}
 				}
 			$i++;
			}
		?>
	</ul>
</div>
<div class="tab-outer">
	<?php
	$pageID = get_option('page_on_front');
	$subPageArgs = array( 
	   'post_parent'   => $pageID,
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
	} 
	?>
</div>
<?php get_footer(); ?>