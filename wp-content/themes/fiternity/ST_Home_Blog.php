<?php
/**********
Template Name: Home - Blog
**********/
global $postId;
$subPage = get_post($postId);
$linkUrl = get_post_meta($subPage->ID, 'rl_link_url', true);
$linkHeading = get_post_meta($subPage->ID, 'link_heading', true);
$linkTarget = get_post_meta($subPage->ID, 'rl_link_target', true);
$blogArgs = array(
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => 'blog',
    'post_status'      => 'publish', 
    'numberposts'      => -1,
    'meta_query'    => array(
        array(
            'key'       => 'show_in_home',
            'value'     => 'yes',
            'compare'   => '=',
        )
    )
    
);
$blogCollections = get_posts($blogArgs);
if(count($blogCollections)>0) {
?>
 <div class="tile-section tab-content" id="tab-2">
	<div class="container grid-widget">
	    <?php 
        $i=1;
	    foreach($blogCollections as $key => $blogCollection) { 
	     	$category = get_the_terms( $blogCollection->ID, 'blog_cat' );
	     	$totalCount = count($blogCollections);
	     	$squareboxStyle = get_post_meta($blogCollection->ID, 'square_box_style', true);
	     	$titleTag = get_post_meta($blogCollection->ID, 'title_tag', true);
	     	$featImage = wp_get_attachment_url(get_post_thumbnail_id($blogCollection->ID) );
	     	$linkUrl = get_post_meta($blogCollection->ID, 'rl_link_url', true);
			$linkHeading = get_post_meta($blogCollection->ID, 'link_heading', true);
			$linkTarget = get_post_meta($blogCollection->ID, 'rl_link_target', true);
	     	if($i>5) {
				$i = 1;
	     	}
			switch ($i) {
			    case 1:
				    ?>
					<div class="row tile-swapcontainer">
		                <div class="col-8">
		                    <a href="<?php echo get_permalink($blogCollection->ID); ?>" id="<?php echo $category[0]->slug; ?>" class="tile-swapbox <?php echo $category[0]->slug; ?>">
		                    	<div class="tile-swapcontent">                      
				                    <div class="tile-swapcontent-inner">
				                        	<span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>><?php echo $category[0]->name; ?></span>
				                        	<h2><?php echo $blogCollection->post_title; ?></h2>
				                        <p><?php echo $blogCollection->post_excerpt; ?></p>
				                        <?php if($linkHeading != "" && $linkUrl!='') { ?>
				                         <span class="button button-small has-ripple "><?php echo $linkHeading; ?></span>
				                        <?php } ?>
				                    </div>
		                    	</div>
		                    	<?php if($featImage!='') { ?>
				                    <div class="tile-swapimage">
				                      <img src="<?php echo $featImage; ?>" alt="images">
				                    </div>
			                    <?php } ?>
		                    </a>
		                    <?php if($totalCount == $i || ($totalCount == ($key+1))) { ?>
	                    </div>
	                </div>
			        <?php }
			        break;
			    case 2:
			    ?>
			                <div class="row 2">
			                    <div class="col-6">
			                    	<?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
			                    	<a href="<?php echo get_permalink($blogCollection->ID); ?>" class="single-swap">
			                    		<div class="tile-smallimage <?php echo $category[0]->slug; ?> <?php if($squareboxStyle!='') { echo $squareboxStyle; } ?>">
									<?php } else { ?>
											<a href="<?php echo get_permalink($blogCollection->ID); ?>" class="tile-smallimage <?php echo $category[0]->slug; ?> <?php if($squareboxStyle!='') { echo $squareboxStyle; } ?>">
									<?php } ?>
				                    	
					                        <img src="<?php echo $featImage; ?>" alt="">
			                                <?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
			                                  	<div class="colorlay-text">
						                            <span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>><?php echo $category[0]->name; ?></span>
						                            <h3><?php echo $blogCollection->post_title; ?></h3>
						                            <?php 
						                            if($linkHeading != "" && $linkUrl!='') { ?>
						                            <span class="button button-small has-ripple"><?php echo $linkHeading; ?></span>
						                            <?php } ?>
					                          	</div>
											<?php } else { ?>
					                        <div class="imageoverlay"></div>
					                        <div class="info-text">
						                        <span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>><?php echo $category[0]->name; ?></span>
						                        <h4><?php echo $blogCollection->post_title; ?></h4>
					                        </div>
					                        <?php } ?>
				                    	
									<?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
									</div>
									</a>
									<?php } else { ?>
                                    </a>
									<?php } ?>
			                    </div>
			        			<?php if($totalCount == $i  || ($totalCount == ($key+1))) { ?>
		                    </div>
		                </div>
		            </div>
				    <?php }
			        break;
			    case 3:
			    ?>
						    <div class="col-6">
						    	<?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
		                    		<a href="<?php echo get_permalink($blogCollection->ID); ?>" class="single-swap">
		                    			<div class="tile-smallimage <?php echo $category[0]->slug; ?> <?php if($squareboxStyle!='') { echo $squareboxStyle; } ?>">
 							 	<?php } else { ?>
										<a href="<?php echo get_permalink($blogCollection->ID); ?>" class="tile-smallimage <?php echo $category[0]->slug; ?> <?php if($squareboxStyle!='') { echo $squareboxStyle; } ?>">
								<?php } ?>
			                    	
				                    	<?php if($featImage!='') { ?>
				                        <img src="<?php echo $featImage; ?>" alt="">
				                        <?php } ?>
	                                      <?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
	                                      <div class="colorlay-text">
				                            <span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>><?php echo $category[0]->name; ?></span>
				                            <h3><?php echo $blogCollection->post_title; ?></h3>
				                            <?php if($linkHeading != "" && $linkUrl!='') { ?>
				                            <span class="button button-small has-ripple "><?php echo $linkHeading; ?></span>
				                            <?php } ?>
				                          </div>
	   									<?php } else { ?>
				                        <div class="imageoverlay"></div>
				                        <div class="info-text">
					                        <span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>><?php echo $category[0]->name; ?></span>
					                        <h4><?php echo $blogCollection->post_title; ?></h4>
				                        </div>
				                        <?php } ?>
			                    	
			                    <?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
			                    </div>
 							 		</a>
 							 <?php } else { ?>
                                </a>
								<?php } ?>
			                </div>
			            </div>
			        </div>
		        <?php if($totalCount == $i  || ($totalCount == ($key+1))) { ?>
                </div>
		        <?php }
			        break;
			    case 4:
			    ?>
				    <div class="col-4">
				    	<?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
		                    <a href="<?php echo get_permalink($blogCollection->ID); ?>" class="single-swap">
		                    	<div class="tile-smallimage <?php echo $category[0]->slug; ?> <?php if($squareboxStyle!='') { echo $squareboxStyle; } ?>">
 							 	<?php } else { ?>
 							 		<a href="<?php echo get_permalink($blogCollection->ID); ?>" id="<?php echo $category[0]->slug; ?>" class="tile-smallimage tile-smallBox <?php echo $category[0]->slug; ?> <?php if($squareboxStyle!='') { echo $squareboxStyle; } ?>">
 							 	<?php } ?>
 								
 									<?php if($featImage!='') { ?>
			                        <img src="<?php echo $featImage; ?>" alt="">
			                        <?php } ?>
                                      <?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
	                                      	<div class="colorlay-text">
					                            <span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>><?php echo $category[0]->name; ?></span>
					                            <h3><?php echo $blogCollection->post_title; ?></h3>
					                            <?php if($linkHeading != "" && $linkUrl!='') { ?>
					                            	<span class="button button-small has-ripple"><?php echo $linkHeading; ?></span>
					                            <?php } ?>
				                          	</div>
   									<?php } else { ?>
				                        <div class="<?php echo $category[0]->slug; ?> <?php if($squareboxStyle!='') { echo $squareboxStyle; } ?>">
						                    <span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>><?php echo $category[0]->name; ?></span>
						                    <h3><?php echo $blogCollection->post_title; ?></h3>
						                    <p><?php echo $blogCollection->post_excerpt; ?></p>
						                </div>
			                        <?php } ?>
						<?php if($squareboxStyle == "red-overlay" || $squareboxStyle == "yellow-overlay") { ?>
						</div>
 							</a>
 							 <?php } else { ?>
			                    </a>

 							 <?php } ?>
	                  	<?php if($totalCount == $i  || ($totalCount == ($key+1))) { ?>
					</div>
                </div>
                <?php } 
			        break;
			    case 5:
			    ?>
			            <a href="<?php echo get_permalink($blogCollection->ID); ?>" class="tile-swapimage <?php echo $category[0]->slug; ?> mobile-swap">
				                	<?php if($featImage!='') { ?>
				                    	<img src="<?php echo $featImage; ?>" alt="images">
				                    <?php } ?>
				            <div class="info-text">
					            <span <?php if($titleTag!='') { echo 'class="'.$titleTag.'"'; } ?>>Life</span>
					            <h4><?php echo $blogCollection->post_title; ?></h4>
				            </div>
			            </a>
		                </div>
		            </div>
			    	<?php
			        break;
			    default:
			        break;
			}
	    	$i++;
	    }  
	   ?>
    	<!-- <div class="alignBtn">
              <a href="#" class="button">Load More</a>
            </div> -->
	</div>
</div>
<?php } ?>