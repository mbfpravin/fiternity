<?php
/*
Template Name: Contact
*/
get_header();
global $wpdb;
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$defaultImage = get_option('default_image');
if($featImage!='') {
  $image = $featImage;
} else {
  $image = $defaultImage;
}
if ($_POST['contact_us_form'] != "" && $_POST['contactform'] == "") {
	$table = $wpdb->prefix . "contact";
	$data['name']        = sanitize_text_field($_POST['firstname']);
	$data['email']            = sanitize_text_field($_POST['email']);
	$data['telephone']        = sanitize_text_field($_POST['telephone']);
	$data['message']          = nl2br($_POST['message']);
	$data['posted_date']      = date('Y-m-d H:i:s');
	$format = array('%s','%s','%s','%s','%s');
	$err = 0;
		if (empty($data['name'])) {
			$error['name'] = "Please enter your name";
			$err++;
		}
		if (empty($data['telephone'])) {
			$error['telephone'] = "Please enter your telephone number";
			$err++;
		}
		
		if (empty($data['email'])) {
			$error['email'] = "Please enter your email";
			$err++;
		}
		if (empty($data['message'])) {
			$error['message'] = "Please enter your message";
			$err++;
		}
		
		if (empty($err)) {
			$insert_contact = $wpdb->insert($table, $data, $format);
			$lastid = $wpdb->insert_id;
			if($lastid != "") { ?>
			
			<?php $message = '
				<html>
					<body>
						<div style="max-width:500px">
							<p>Dear,<br /><br />

							The following message was submitted through the website today.<br /><br />

						   ---- Message ----<br /><br />

								Name - '. $data['name'] .'<br />
								Email - ' . $data['email'] . ' <br />
								Phone - ' . $data['telephone'] . '<br />
								Message - '. $data['message'] . '<br />
							</p>
						</div>
					</body>
				</html>'
			?>
			<?php $senderMessage = '
				<html>
					<body>
						<div style="max-width:500px">
							<p>Dear '. ucwords($data['name']) .',<br /><br />

							   Thank you for writing to us. We have forwarded your email to the
							   right department and you should get an answer back in 48 hours.<br /><br />

							   Regards,<br /><br />

							   Team CR<br /><br />

							   ---- Your message ----<br /><br />

							   Name - '. $data['name'] .' <br />
							   Email - ' . $data['email'] . ' <br />
							   Phone - ' . $data['telephone'] . ' <br />
							   Your Message - ' . $data['message'] . ' <br />
							</p>
						</div>
					</body>
				</html>';
				  $from = "Fiternity <no-reply@fiternity.in>";
				  $subject = "Message from the Fiternity website";
				  $headers = "MIME-Version: 1.0" . "\r\n";
				  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				  $headers .= "From: " .  $from."\r\n";
				  $to = get_option('contact_us_email');
				  
				  if (wp_mail($to, $subject, $message, $headers)) {
				  $to = $data['email'];

				  $subjectSender ="Fiternity - Your message has been received.";
				  if (wp_mail($to, $subjectSender, $senderMessage, $headers)) {
				  unset($_POST);
				  $redirect_url = get_bloginfo('url') . "/contact-us/thank-you/";
				  echo "<script type=\"text/javascript\">";
        			echo "window.location='" . get_bloginfo('url') . "/contact-us/thank-you/'";
		          echo "</script>";
				  exit;
				  }
				}
			}
		}
	}
?>
<!-- <section class="subBanner">
	<div class="container">
		<div class="parallaxBg subBanner-bg" style="background-image: url(<?php echo $image; ?>);"></div>
	</div>

</section> -->
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
		<div class="col-8 generic-content">

			<h1><?php echo $post->post_title; ?></h1>
			<?php echo apply_filters('the_content',$post->post_content); ?>
			<div class="form-wrap">
				<form name="contact_us_frm" id="contact_us_frm" method="post" action="">
					<?php wp_nonce_field('conactus_nonce','contact_us_form'); ?>
					<div class="form-row">
						<label class="floating-item" data-error="Please enter your name">
							<input type="text" class="floating-item-input input-item" name="firstname" id="firstname" maxlength="75" value="" onkeypress="return onlyAlphabets(event, this)" />
							<span class="floating-item-label">Name</span>
						</label>
						<div class="error-message" id="err_name">Please enter your name</div>
					</div>
					<div class="form-row">
						<label class="floating-item" data-error="Please enter your email address">
							<input type="text" class="floating-item-input input-item validate-email" name="email" id="email" value="" />
							<span class="floating-item-label">Email address</span>
						</label>
						<div class="error-message" id="err_email">Please enter your email address</div>	
					</div>
					<div class="form-row">
						<label class="floating-item" data-error="Please enter your telephone number">
							<input type="text" class="floating-item-input input-item validate-mobile" name="telephone" id="telephone" value="" onkeypress="return isNumber(event)" />
							<span class="floating-item-label">Telephone</span>
						</label>
						<div class="error-message" id="err_telephone">Please enter your telephone number</div>
					</div>
					<div class="form-row">
						<label class="floating-item" data-error="Please enter your message">
							<textarea class="floating-item-input input-item message-area" maxlength="2000" rows="5" name="message" id="message" value=""></textarea>
							<span class="floating-item-label">Message</span>
						</label>														
						<div class="error-message" id="err_message">Please enter your message</div>
					</div>
					<div id ="dispnone" class="dispnone" style="display: none;">
			   			<input type="text" name="contactform" id="contactform" value="">
			 		</div>
					<div class="dbl-button">
						<button class="button" name="contact_submit" id="contact_submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
