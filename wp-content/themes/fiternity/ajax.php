<?php
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0] . 'wp-load.php';
global $wpdb;
$table = $wpdb->prefix . "newsletter";
$mailid = (isset($_POST["email"]) && $_POST["email"]!="") ? $_POST["email"] : '';
$sql = "SELECT * FROM ".$table." WHERE email = '".$mailid."'";
$mylink = $wpdb->get_row( $sql );
if($mylink->id == "")
    {
        $wpdb->insert( 
			$table, 
			array( 
				'email' => $mailid, 
				'posted_date' => date("Y-m-d h:i:s")
			), 
			array( 
				'%s', 
				'%s' 
			) 
		);
		if ($wpdb->insert_id) {
		$message = '<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:cctd="http://www.constantcontact.com/cctd">
		<head>
		</head>
		<body>
		<table width="640" cellpadding="0" cellspacing="0" border="0" align="center" style="background-image:url(http://www.madebyfire.co.uk/demo/ShowUp/img/header-img.jpg); background-repeat:no-repeat;background-color:#eee; padding:20px 40px 50px;">
		  <tr style="background:#fff">
		    <td align="center" style="padding:0;"><a href="#"><img src="https://cms.fiternity.co/Showupimages/logo-emailer.png" alt=""></a></td>
		  </tr>
		  <tr style="background:#fff">
		  	<td align="center" style="color:#404041; padding:35px 50px 25px;">
		    	<h1 style=" font-size:24px; font-weight:700; padding:0 0 20px; margin:0;">Thank You!</h1>
		    	<p style="font-size:18px; margin:0; line-height:36px;">Thank you for signing up for our e-newsletter​! You have been added to our mailing list and will be among the first to hear about our updates, big events and latest articles​!</p>
		    <td>
		  </tr>
		  <tr style="background:#eee">
		  	<td align="center" style="color:#404041; padding:25px 55px 30px;">
		    	<p style=" color:#333; display: inline-block; font-size:14px; margin:0; line-height:50px; vertical-align:top;">Want to see how we ShowUp? <strong>Follow us!</strong> </p>
		        <a href="#" style="margin-left:20px;"><img src="http://www.madebyfire.co.uk/demo/ShowUp/img/instagram.jpg" alt=""></a><a href="#" style="margin-left:20px;"><img src="http://www.madebyfire.co.uk/demo/ShowUp/img/tweet.jpg" alt=""></a>
		    <td>
		  </tr>
		  <tr>
		  	<td align="center" style="color:#404041; padding:25px 55px 0px;">
		    	<p style=" color:#333; display: inline-block; font-size:14px; margin:0; line-height:24px;">This email was sent to you because you registered your email with us. If you did not register with us, please ignore this email.</p>
		    <td>
		  </tr>
		</table>
		</body>
		</html>';
        $subject = "Fiternity App: Website Signup";
        $to = $mailid;                    
        $from = "Fiternity <info@fiternity.co>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= "From: " . $from . "\r\n";
        mail($to, $subject, $message, $headers);
	echo 1;   
	}    
    }
    else
    {
        echo 2;
    }