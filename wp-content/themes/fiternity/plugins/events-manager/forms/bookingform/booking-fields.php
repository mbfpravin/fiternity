<?php
/* 
 * This file generates the default booking form fields. Events Manager Pro does not use this file.
 */
/* @var $EM_Event EM_Event */ 
//Here we have extra information required for the booking. 
?>
<?php //if( !is_user_logged_in() && apply_filters('em_booking_form_show_register_form',true) ): ?>
	<?php //User can book an event without registering, a username will be created for them based on their email and a random password will be created. ?>
		<input type="hidden" name="register_user" value="1" />
		<div class="form-row total_price_val">
			<label for='total_price' class="floating-item">
			<input type="text" name="total_price" id="total_price" class="floating-item-input input-item input-email-active" value="" readonly/>
			<span class="floating-item-label">Total price(&pound;)</span>
			</label>
		</div>
		<div class="form-row">
			<label for='user_name' class="floating-item" data-error="Please enter your name">
			<input type="text" name="user_name" id="user_name" class="floating-item-input input-item" value="<?php if(!empty($_REQUEST['user_name'])) echo esc_attr($_REQUEST['user_name']); ?>" />
			<span class="floating-item-label">Name</span>
			</label>
			<div class="error-message" id="err_user_name"></div>
		</div>
		<div class="form-row">
			<label for='dbem_phone' class="floating-item" data-error="Please enter your telephone number">
			<input type="text" name="dbem_phone" id="dbem_phone" class="floating-item-input input-item validate-mobile" maxlength="12" value="<?php if(!empty($_REQUEST['dbem_phone'])) echo esc_attr($_REQUEST['dbem_phone']); ?>" />
			<span class="floating-item-label">Telephone</span>
			</label>
			<div class="error-message" id="err_telephone"></div>
		</div>
		<div class="form-row">
			<label for='user_email' class="floating-item" data-error="Please enter your email address">
			<input type="text" name="user_email" id="user_email" class="floating-item-input input-item validate-email" value="<?php if(!empty($_REQUEST['user_email'])) echo esc_attr($_REQUEST['user_email']); ?>"  />
			<span class="floating-item-label">Email address</span>
			</label> 
			<div class="error-message" id="err_user_email"></div>
		</div>
	<?php do_action('em_register_form'); //careful if making an add-on, this will only be used if you're not using custom booking forms ?>					
<?php //endif; ?>		
	<!-- <p>
		<label for='booking_comment'><?php _e('Comment', 'events-manager') ?></label>
		<textarea name='booking_comment' rows="2" cols="20"><?php echo !empty($_REQUEST['booking_comment']) ? esc_attr($_REQUEST['booking_comment']):'' ?></textarea>
	</p> -->