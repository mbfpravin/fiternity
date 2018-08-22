<?php 
$currentYear = date("Y");
$designYear = 2016;
$year = ($currentYear > $designYear) ? $designYear." - ".date("y") : $currentYear;
?>
			<footer>
				<div class="container">
					<div class="row copy-rights">
						<div class="col-7">
							<div class="content">
								<h3>Keep up to date with our</h3>
								<h3>newsletters and social channels</h3>
							</div>   
							<form class="form-element form-row">
								<input type="text" class="form" id="subscribe-email" placeholder="Enter your email"/>
								<div class="newlettersub-btn subBtn" id="subscribe-button">
								  <a href="javascript:void(0);">subscribe</a>
								</div>
								<div class="error-message" id="err_sub_email"></div>
								<div class="error-message msg_sub">Thanks for subscribing successfully!!</div>
								<div class="error-message err-msg">Your email address is already subscribed.</div>
							</form>
							<?php 
								$facebook = get_option('facebook');
								$instagram = get_option('instagram');
								$twitter = get_option('twitter');
							?>
							<?php if($facebook!='' || $instagram!='' || $twitter!='') { ?>
							    <ul class="social-menu">
									<?php if($facebook!='') { ?>
										<li>
										  <a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										</li>
									<?php } ?>
									<?php if($instagram!='') { ?>
										<li>
										  <a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
										</li>
									<?php } ?>
									<?php if($twitter!='') { ?>
										<li>
										  <a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</li>
									<?php } ?>
							    </ul>
							<?php } ?>        
						</div>
						<?php if(get_option('app_store')!='' || get_option('play_store')!='') { ?>
							<div class="col-5">
								<div class="content">
									<h3>Download the Fiternity App</h3>
									<h3>and experience the wellness!</h3>
								</div>
								<?php if(get_option('app_store')!='') { ?>
									<div class="appstore">
										<a href="<?php echo get_option('app_store'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_url');?>/img/app-store.png" alt=""></a>
									</div>
								<?php } ?>
								<?php if(get_option('play_store')!='') { ?>
									<div class="appstore">
										<a href="<?php echo get_option('play_store'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_url');?>/img/app-store.png" alt=""></a>
									</div>
								<?php } ?>                  
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="container">
			        <div class="row bottomLine"> 
			          <div class="copy col-5">
			            <ul class="privacy">
			              <?php dropDownMenu('footer_menu'); ?>
			            </ul>
			          </div>                   
			          <div class="col-7 order-first">
			            <span>&copy;<?php echo $year; ?> showup London Ltd. </span>All rights reserved / <a target="_blank" href="https://www.madebyfire.com/">Made by Fire</a>
			          </div>
			        </div>
			    </div>
			</footer>
		</div>
		<?php wp_footer(); ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
		<script src="<?php echo get_bloginfo('template_url');?>/js/bodymovin.js"></script>
		<script src="<?php echo TMPL_URL; ?>/js/app.js"></script>
		<script src="<?php echo get_bloginfo('template_url');?>/js/charming.min.js"></script>
		<script src="<?php echo get_bloginfo('template_url');?>/js/anime.min.js"></script>
		<script src="<?php echo TMPL_URL; ?>/js/lib/custom.js"></script>
	</body>
</html>