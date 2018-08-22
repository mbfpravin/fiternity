<?php 
get_header(); 
$post_term=get_queried_object();
$curr_term_id = get_queried_object()->term_id;
$curr_term_name = get_queried_object()->name;
$curr_term_content = get_queried_object()->description;
?>

	<!-- <div class="row"> -->
		<div class="banner-bg">
			<div class="container">
				<div class="bread-crumb">
					<ul class="clearfix">
					<?php
					if (function_exists('bcn_display')) {
						bcn_display();
					}
					?>
					</ul>
				</div>
	        	<h1><?php echo $curr_term_name; ?></h1>
	        	<p><?php echo $curr_term_content; ?></p>
        	</div>
	    </div>

		
			<?php
			global $postId;
$noOfPost=6;
$blogFitArgs = array(
    'order'            => 'ASC',
    'post_type'        => 'blog',
    'post_status'      => 'publish', 
    'numberposts'      => -1,
     'tax_query'	=> array(
					array(
						'taxonomy'	=> 'blog_cat',
						'field'		=> 'term_id',
						'terms'		=> $curr_term_id
					) 
				)
);
$blogCollCount = get_posts($blogFitArgs);
$blogArgs = array(
    'orderby'          => 'date',
    'order'            => 'DSC',
    'post_type'        => 'blog',
    'post_status'      => 'publish', 
    'numberposts'      => $noOfPost,
     'tax_query'	=> array(
					array(
						'taxonomy'	=> 'blog_cat',
						'field'		=> 'term_id',
						'terms'		=> $curr_term_id
					) 
				)
);
$blogCollections = get_posts($blogArgs);
//var_dump(count($blogCollections));


?>
		<div class=" gray-bg tab tile-section tab-content" id="tab-2">
			<div class="container">
			<div class="grid-widget">
				
				<!-- <div class="row tile-swapcontainer"> -->
			            <!-- <div class="col-12"> -->
							<div id="life" class="row">
								    <?php 
							        
								    foreach($blogCollections as $key => $blogCollection) { 
								     	$category = get_the_terms( $blogCollection->ID, 'blog_cat' );
								     	$totalCount = count($blogCollections);
								     	$squareboxStyle = get_post_meta($blogCollection->ID, 'square_box_style', true);
								     	$titleTag = get_post_meta($blogCollection->ID, 'title_tag', true);
								     	$featImage = wp_get_attachment_url(get_post_thumbnail_id($blogCollection->ID) );
								     	$linkUrl = get_post_meta($blogCollection->ID, 'rl_link_url', true);
										$linkHeading = get_post_meta($blogCollection->ID, 'link_heading', true);
										$linkTarget = get_post_meta($blogCollection->ID, 'rl_link_target', true);
								     	
								     	$imageId = MultiPostThumbnails::get_post_thumbnail_id('blog', 'blogicon', $blogCollection->ID);
										$imageUrl = wp_get_attachment_url($imageId, NULL);
										?>
										<div class="slider-blk col-4 blog_col" data-count="<?php echo count($countPosts); ?>"   data-id=" <?php echo $blogCollection->ID; ?>">
									  	<a href="<?php echo get_permalink($blogCollection->ID); ?>"><img src="<?php echo $imageUrl; ?>" alt="slider"/>
									  	<div class="whitebox">
									  	<span class="post-date"><strong><?php echo get_the_date( 'F jS', $blogCollection->ID); ?>
													</strong><?php echo get_the_date( ' Y', $blogCollection->ID); ?></span>
												<h3><span class="newtag"><?php echo $curr_term_name; ?></h3>
											     <h4><?php echo $blogCollection->post_title; ?></h4>
											     
									  	</div></a>
									</div>
										<?php
								    	$i++;
								    }  
								   ?>
							</div>
									<input type="hidden" id="cat_id" value="<?php echo $curr_term_id; ?>">
									<input type="hidden" id="cat_name" value="<?php echo $curr_term_name; ?>">
									<input type="hidden" id="pst_count" value="<?php echo count($blogCollCount); ?>">
									<span class="learn-more-service" id="ajax-learnmore" ></span> 
				<?php if(count($blogCollCount)>$noOfPost){ ?>
					<div class="alignBtn" id="loadMore">
				              <a href="javascript:void(0)" id="load-more-products" class="button button-big">Load More</a>
				    </div>
			    <?php } ?>
			</div>
		</div>
	<!-- </div> -->
</div>
</div>
<?php get_footer(); ?>