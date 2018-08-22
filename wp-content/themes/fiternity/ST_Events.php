<?php
/**********
Template Name: Events
**********/
get_header();
$today = time();
$subPage = get_post($postId);
$noOfPost =3;
$eventPages = EM_Events::get(array("orderby"=>"event_start_date", 
 "order"=>"DESC",
 'meta_query' => array(
        array(
            'key' => 'event_end_date',
            'value' => $today,
            'compare' => '>=',
        )
    ),));

$eventsCount = EM_Events::count();
?>
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
					<div>
			<h1><?php echo $post->post_title; ?></h1>
			<?php echo apply_filters('the_content',$post->post_content); ?>
		</div>
	</div>
</div>
<?php if(is_array($eventPages) && $eventsCount > 0){ ?>
<div class="gray-bg tile-section cont-events">
	<div class="container">
		<div class="row" id="eventList">
			<?php 
			foreach ($eventPages as $key => $eventPage) { 
				if($key==3){
					continue;

				}
				$eventFeatImage = wp_get_attachment_url(get_post_thumbnail_id($eventPage->ID) );
				$startDate = $eventPage->event_start_date;
			  	$endDate = $eventPage->event_end_date;
			  	$eventCategory = get_the_terms( $eventPage->ID, 'event-categories' );
			  	$location = $eventPage->get_location();
 				$tickets = $eventPage->get_tickets();
 				$seats = $eventPage->get_spaces();
 				foreach( $tickets->tickets as $EM_Ticket ){
                    $price = $EM_Ticket->get_price();									
				}
				$price = (float)$price;
				$availableSeats = $eventPage->get_bookings()->get_available_spaces();

				?>
				<div class="slider-blk col-4 event_col" data-count="<?php echo count($eventsCount); ?>"   data-id=" <?php echo $eventPage->ID; ?>">
					<a href="<?php echo get_permalink($eventPage->ID); ?>">
		            	<img src="<?php echo $eventFeatImage; ?>" alt="slider"/></a>
			            <div class="whitebox">
			              	<?php if($startDate!='') { ?>
								<span class="post-date"><strong><?php echo date('d F', strtotime($startDate)); ?></strong> <?php echo date('Y', strtotime($startDate)); ?></span>
							<?php } ?>
							    <h4><?php echo $eventPage->post_title; ?></h4>
		                      	<?php if($eventCategory[0]->name!='') { ?>
									<h3><?php echo $eventCategory[0]->name; ?></h3>
								<?php } ?>

			              		<div class="price-detail">
									<?php if($price!='' || $price!=0) {
													$price = number_format($price, 2, '.', '');
												?>
											  		<span> &#163;<?php echo $price; ?></span>
											  	<?php } else { ?>
											  		<span><strong>Free</strong></span>
											  	<?php } ?>
									<a href="<?php echo get_permalink($eventPage->ID); ?>" class="button button-big">Book now</a>
								</div>

			            </div>
            		
          		</div>
			<?php } ?>
		</div>
		
	</div>
	<input type="hidden" id="event_count" value="<?php echo count($eventsCount); ?>">
		<?php if(count($eventsCount)<$eventPages){ ?>
			<div class="alignBtn" id="loadMoreEvent">
              	<a href="javascript:void(0)" id="load-more-events" class="button button-big">Load More</a>
		    </div>
		    <?php } ?>
</div>
<?php } ?>
<?php get_footer(); ?>

