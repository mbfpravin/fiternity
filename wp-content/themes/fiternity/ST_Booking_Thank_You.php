<?php
/*
Template Name: Booking - Thank you
*/
get_header(); 
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$defaultImage = get_option('default_image');
if($featImage!='') {
  $image = $featImage;
} else {
  $image = $defaultImage;
}
if(isset($_REQUEST["trans_id"])) {
	$transactionId = base64_decode($_REQUEST["trans_id"]);
	$query = "SELECT * FROM ".$wpdb->prefix."bookings WHERE `charge_id`='".$transactionId."' ORDER BY `payment_date` desc";
	$result = $wpdb->get_row($query);
}
?>
<div class="container">
	<div class="row">
		<div class="col-8 generic-content">
			<h1><?php echo $post->post_title; ?></h1>
			<?php
			if($result->amount!="Free") {
				$amt = ($result->amount/100);
			} else {
				$amt = 'Free';
			}
			?>
			<?php echo apply_filters('the_content',$post->post_content); ?>
			<h3>Your order Details:</h3>
			<div class="payment-details">
				<?php if($result->amount!="Free") { ?>
				<p><strong>Your Transaction ID:</strong> <?php echo $transactionId; ?></p>
				<?php } ?>
				<p><strong>Event name:</strong> <?php echo $result->event_name; ?></p>
				<p><strong>Amount(&pound;):</strong> <?php echo $amt; ?></p>
				<p><strong>No.of.seats booked:</strong> <?php echo $result->no_of_seats; ?></p>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
