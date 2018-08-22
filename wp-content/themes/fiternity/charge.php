<?php
require_once('Stripe/init.php');
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0] . 'wp-load.php';
$table = $wpdb->prefix . "bookings";
$eventId = $_POST["event_id"];
$itemAmount = $_POST['amount'];
$seats = $_POST["em_tickets"][$eventId]["spaces"];
$stripeAmount = $itemAmount*$seats;
// Need a payment token:
if (isset($_POST['stripeToken'])) {
	$token = $_POST['stripeToken'];
	// Check for a duplicate submission, just in case:
	// Uses sessions, you could use a cookie instead.
	if (isset($_SESSION['token']) && ($_SESSION['token'] == $token)) {
		$errors['token'] = 'You have apparently resubmitted the form. Please do not do that.';
	} else { // New submission.
		$_SESSION['token'] = $token;
	}
}
if (isset($_POST['stripeEmail'])) {
   $customerEmail = $_POST['stripeEmail'];
}
$customerName = $_POST["user_name"];

if($itemAmount!="000" || $itemAmount != 000) {
	try {
		\Stripe\Stripe::setApiKey("sk_test_m6Q54GSaMI0L5aJOzN8FQJkL");
			$charge = \Stripe\Charge::create(array(
			"amount" => $stripeAmount,
			"currency" => "gbp",
			"card" => $token,
			"description" => "fiternity"
		));
	} catch (\Stripe\Error\Card $e) {
		// Card was declined.
	  	$e_json = $e->getJsonBody();
	  	$err = $e_json['error'];
	  	$errors['stripe'] = $err['message'];
	} catch (\Stripe\Error\ApiConnection $e) {
	  	$errors['network'] = 'Network problem, perhaps try again.';
		// Network problem, perhaps try again.
	} catch (\Stripe\Error\InvalidRequest $e) {
	  	$errors['invalid'] = "Invalid request!";
		// You screwed up in your programming. Shouldn't happen!
	} catch (\Stripe\Error\Api $e) {
	  	$errors['server'] = "Stripe's servers are down!";
		// Stripe's servers are down!
	} catch (\Stripe\Error\Base $e) {
	  	$errors['something'] = "Something else that's not the customer's fault.";
		// Something else that's not the customer's fault.
	}
	if (isset($errors) && !empty($errors) && is_array($errors)) {
		echo '<div class="alert alert-error"><h4>Error!</h4>The following error(s) occurred:<ul>';
		foreach ($errors as $e) {
			echo "<li>".$e."</li>";
		}
		echo '</ul></div>';
	}
	$chargeId = $charge->id;
	$txnId = $charge->balance_transaction;
	$paidCurrency = $charge->currency;
	$status = $charge->status;
	$statusCode = $charge->code;
	if ($charge->paid == true) {
		$data['event_id'] = sanitize_text_field($_POST['event_id']);
		$data['customer_email'] = sanitize_text_field($customerEmail);
		$data['customer_name'] = sanitize_text_field($_POST['user_name']);
		$data['customer_phone'] = sanitize_text_field($_POST['dbem_phone']);
		$data['event_name'] = sanitize_text_field($_POST['eventname']);
		$data['ticket_name'] = sanitize_text_field($_POST['ticket_name']);
		$data['charge_id'] = sanitize_text_field($chargeId);
		$data['txn_id'] = sanitize_text_field($txnId);
		$data['amount'] = sanitize_text_field($charge->amount);
		$data['currency'] = sanitize_text_field($paidCurrency);
		$data['status'] = sanitize_text_field($status);
		$data['stripe_token'] = sanitize_text_field($token);
		$data['no_of_seats'] = sanitize_text_field($seats);
		$data['response'] = sanitize_text_field(json_encode($charge));
		$data['payment_date'] = date('Y-m-d H:i:s');
		$insertData = $wpdb->insert($table, $data);
		$lastid = $wpdb->insert_id;
		if($lastid!='') {
			$message = '
				<html>
					<body>
						<div style="max-width:500px">
							<p>Dear,<br /><br />

							The following message was submitted through the website today.<br /><br />

						   ---- Message ----<br /><br />

								Event Name - '. $data['event_name'] .'<br />
								Amount - ' . $data['amount'] . '<br />
								No.of.seats booked - '. $data['no_of_seats'] . '<br />
								Date - '. $data['payment_date'] . '<br />
								Transaction ID - ' . $data['charge_id'] . ' <br />
							</p>
						</div>
					</body>
				</html>'
			?>
			<?php $senderMessage = '
				<html>
					<body>
						<div style="max-width:500px">
							<p>Dear '. ucwords($customerName) .',<br /><br />

							  Thank you for booking the event through our website. Please find your booking details below:<br /><br />

							   Regards,<br /><br />

							   Team Fiternity<br /><br />

							   ---- Your message ----<br /><br />

								Event Name - '. $data['event_name'] .'<br />
								Amount - ' . $data['amount'] . '<br />
								No.of.seats booked - '. $data['no_of_seats'] . '<br />
								Transaction ID - ' . $data['charge_id'] . ' <br />
								Date - '. $data['payment_date'] . '<br />
							</p>
						</div>
					</body>
				</html>';
				$from = "Fiternity <no-reply@fiternity.in>";
				$subject = "Booking from the Fiternity website";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				$headers .= "From: " .  $from."\r\n";
				  $to = get_option('booking_order_email');
				if (wp_mail($to, $subject, $message, $headers)) {
				  	$to = $customerEmail;
				  	$subjectSender ="Fiternity - Your booking has been received.";
				  	if (wp_mail($to, $subjectSender, $senderMessage, $headers)) {
					  	unset($_POST);
					  	$redirect_url = get_bloginfo('url').'/events/thank-you/?trans_id='.base64_encode($chargeId);
					 	wp_redirect( $redirect_url );
				  		exit;
				  	}
				} else {
					unset($_POST);
				   	$redirect_url = get_bloginfo('url').'/events/thank-you/?trans_id='.base64_encode($chargeId);
				  	wp_redirect( $redirect_url );
				}
		} else {
			echo 'Sorry! Some problem occured.';
		}
	}
} else {
	$data['event_id'] = sanitize_text_field($_POST['event_id']);
	$data['customer_email'] = sanitize_text_field($_POST['user_email']);
	$data['customer_name'] = sanitize_text_field($_POST['user_name']);
	$data['customer_phone'] = sanitize_text_field($_POST['dbem_phone']);
	$data['event_name'] = sanitize_text_field($_POST['eventname']);
	$data['ticket_name'] = sanitize_text_field($_POST['ticket_name']);
	$data['charge_id'] = 'free_'.date("M_d_Y_H_i").rand();
	$data['txn_id'] = '0';
	$data['amount'] = 'Free';
	$data['currency'] = 'gbp';
	$data['status'] = 'succeeded';
	$data['stripe_token'] = '0';
	$data['no_of_seats'] = sanitize_text_field($seats);
	$data['response'] = 'NULL';
	$data['payment_date'] = date('Y-m-d H:i:s');
	$insertData = $wpdb->insert($table, $data);
	$lastid = $wpdb->insert_id;

	if($lastid!='') {
		$message = '
			<html>
				<body>
					<div style="max-width:500px">
						<p>Dear,<br /><br />

						The following message was submitted through the website today.<br /><br />

					   ---- Message ----<br /><br />

							Event Name - '. $data['event_name'] .'<br />
							Amount - ' . $data['amount'] . '<br />
							No.of.seats booked - '. $data['no_of_seats'] . '<br />
							Date - '. $data['payment_date'] . '<br />
							Transaction ID - ' . $data['charge_id'] . ' <br />
						</p>
					</div>
				</body>
			</html>'
		?>
		<?php $senderMessage = '
			<html>
				<body>
					<div style="max-width:500px">
						<p>Dear '. ucwords($customerName) .',<br /><br />

						  Thank you for booking the event through our website. Please find your booking details below:<br /><br />

						   Regards,<br /><br />

						   Team Fiternity<br /><br />

						   ---- Your message ----<br /><br />

							Event Name - '. $data['event_name'] .'<br />
							Amount - ' . $data['amount'] . '<br />
							No.of.seats booked - '. $data['no_of_seats'] . '<br />
							Transaction ID - ' . $data['charge_id'] . ' <br />
							Date - '. $data['payment_date'] . '<br />
						</p>
					</div>
				</body>
			</html>';
	    $from = "Fiternity <no-reply@fiternity.in>";
	    $subject = "Booking from the Fiternity website";
	  	$headers = "MIME-Version: 1.0" . "\r\n";
	  	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	  	$headers .= "From: " .  $from."\r\n";
		$to = get_option('booking_order_email');
		if (wp_mail($to, $subject, $message, $headers)) {
			$to = $customerEmail;
			$subjectSender ="Fiternity - Your booking has been received.";
			if (wp_mail($to, $subjectSender, $senderMessage, $headers)) {
				unset($_POST);
				$redirect_url = get_bloginfo('url').'/events/thank-you/?trans_id='.base64_encode($data['charge_id']);
				wp_redirect( $redirect_url );
				exit;
			}
		} else {
			unset($_POST);
		   	$redirect_url = get_bloginfo('url').'/events/thank-you/?trans_id='.base64_encode($data['charge_id']);
		  	wp_redirect( $redirect_url );
		}
	}
}