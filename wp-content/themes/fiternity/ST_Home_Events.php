<?php
/**********
Template Name: Home - Events
**********/
global $postId;
$today = time();
$subPage = get_post($postId);
$eventCollections = EM_Events::get(array("orderby"=>"event_start_date","order"=>"DESC",'meta_query' => array(
        array(
            'key' => 'event_end_date',
            'value' => $today,
            'compare' => '>=',
        )
    ),));

$eventsCount = EM_Events::count();
?>
<section class="homebanner tab-content"  id="tab-1">
	<div class="container">
	   <!--  <div class="watermark"><?php echo $subPage->post_title; ?></div> -->
		<div class="slider-container">
			<!-- <div class="col-5 banner-content">
			
				<div class="arrow">
					<div class="prevArrow">
					  	<i class="fa fa-angle-left" aria-hidden="true"></i>
					</div>
					<div class="nextArrow">
					  	<i class="fa fa-angle-right" aria-hidden="true"></i>
					</div>
					<?php if(is_array($eventCollections) && $eventsCount > 0){ ?>
						<div class="pagination">
						  	<span class="pagingInfo">1 OF <?php echo $eventsCount; ?></span>
						</div>
					<?php } ?>
				</div>
			</div> -->
			<?php if(is_array($eventCollections) && $eventsCount > 0){ ?>
				
						<div class="slider row">
						 	<?php 
						 	foreach($eventCollections as $event) { 
							  	$featuredImage = wp_get_attachment_url(get_post_thumbnail_id($event->ID));
							  	$startDate = $event->event_start_date;
							  	$endDate = $event->event_end_date;
	                            $category = get_the_terms( $event->ID, 'event-categories' );
	                            $location = $event->get_location();
 								$tickets = $event->get_tickets();
 								$seats = $event->get_spaces();
 								foreach( $tickets->tickets as $EM_Ticket ){
                                    $price = $EM_Ticket->get_price();									
								}
								$price = (float)$price;
								$availableSeats = $event->get_bookings()->get_available_spaces();
						 	?>
							
									<div class="slider-blk ">
										<a href="<?php echo get_permalink($event->ID); ?>"><img src="<?php echo $featuredImage; ?>" alt="slider"/></a>
									  	<div class="whitebox">
									  	    <?php if($startDate!='') { ?>
												<span class="post-date"><strong><?php echo date('d F', strtotime($startDate)); ?></strong> <?php echo date('Y', strtotime($startDate)); ?></span>
											<?php } ?>
											<?php if($event->event_name!='') { ?>
												<a href="<?php echo get_permalink($event->ID); ?>"><h3><?php echo $event->event_name; ?></h3></a>
											<?php } ?>
											<?php if($category[0]->name!='') { ?>
												<a href="<?php echo get_permalink($event->ID); ?>"><h4><?php echo $category[0]->name; ?></h4></a>
											<?php } ?>
                                            
											<div class="price-blk">
											<div class="price-detail">
												<?php if($price!='' || $price!=0) {
													$price = number_format($price, 2, '.', '');
												?>
											  		<span> &#163;<?php echo $price; ?></span>
											  	<?php } else { ?>
											  		<span><strong>Free</strong></span>
											  	<?php } ?>
											  	<?php /* if($availableSeats!='' || $availableSeats!=0) { ?>
											  		<span><strong>Seats</strong> <?php echo $availableSeats; ?> Remaining</span>
											  	<?php } else { ?>
											  		<span> No Seats Remaining</span>
											  	<?php } */ ?>
											  	<a href="<?php echo get_permalink($event->ID); ?>" class="button button-big">Book now</a>
											</div>
										</div>
									  	</div>
									</div>
							
						    <?php 
						    } ?>
						</div>
				
		    <?php } ?>
		</div>
	</div>
</section>