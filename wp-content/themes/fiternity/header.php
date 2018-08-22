<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Fiternity</title>
	  	<script src="<?php echo get_bloginfo('template_url');?>/js/modernizer.js"></script>
	 
	  	<style>
			body{
				background-color: #fff;
			}  
			.render-blk{ opacity:0; }
		</style>
 		<link rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/css/app.css">
		<link rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/style.css"> 
		<!-- <script>
			var cssArr = ['css/app.css','style.css'];
			for(var i = 0; i < cssArr.length; i++) {
				var link = document.createElement('link');
				link.setAttribute('rel', 'stylesheet');
				link.setAttribute('href', '<?php echo TMPL_URL."/"; ?>'+cssArr[i]);
				document.getElementsByTagName('head')[0].appendChild(link);
			}
		</script> -->
		<noscript>
			<style media="screen">
				.render-blk{ opacity: 1; }	
				.intro-hero-banner{
					-webkit-transition-property:inherit;
					-moz-transition-property: inherit;
					-o-transition-property: inherit;
					transition-property: inherit;
					-webkit-transition-duration: inherit;
					-moz-transition-duration: inherit;
					-o-transition-duration: inherit;
					transition-duration: inherit;
					-webkit-transition-delay: inherit;
					-moz-transition-delay: inherit;
					-o-transition-delay: inherit;
					transition-delay: inherit;
					-webkit-transition-timing-function: inherit;
					-moz-transition-timing-function: inherit;
					-o-transition-timing-function: inherit;
					transition-timing-function: inherit;
				}
				.intro-hero-banner-content{ display: block; }
			</style>
		</noscript>
		<script>
			var templateUri = "<?php  echo get_bloginfo('template_url'); ?>";
			var blogUri = "<?php echo get_bloginfo('url'); ?>";
			var tmpl_url = '<?php echo TMPL_URL; ?>';
		</script>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<div class="render-blk subpage">
		<!-- Cookie policy -->
		<?php if(!isset($_COOKIE['cook_pol']) && $_COOKIE["cook_pol"]!=1 ){ ?>

		    <div class="cookiepolicy">
		      <div class="container">
		        <p>Welcome to Fiternity. We use cookies to enhance your visit to our site.     
		        		<a href="<?php echo get_bloginfo('url'); ?>/privacy-policy" target="_blank">Find out more</a><b>.</b></p>
		      </div>
		      <a href="javascript:void(0)" class="button_cookk">I agree <i class="fa fa-close"></i></a>
		    </div>
   		<?php } ?>
       <!-- Cookie policy end -->
		<header>
			<div class="container subheader">
				<div class="row">
					<div class="col-3">
						<?php
						$logo = get_option('header_logo');
						if($logo!='') {
							?>
							<a href="<?php echo get_bloginfo('url'); ?>/" class="logo"><img src="<?php echo $logo; ?>" alt="Logo"/></a>
						<?php } else { ?>
							<a href="<?php echo get_bloginfo('url'); ?>/" class="logo"><img src="<?php echo get_bloginfo('template_url');?>/img/logo.png" alt="Logo"/></a>
						<?php } ?>
					</div>
					<div class="col-9">
						<div class="menu-toggle">
							<div class="one"></div>
							<div class="two"></div>
							<div class="three"></div>
						</div>
					  	<?php ?>
						<nav class="menu menu--ama">
							<ul>

							<?php
							if(!isMobileDevice()) {
								$headerMenus = get_menu('header_menu');
								$breadcrumbDetails = get_option('bcn_options',true);
								$root = "apost_" . $post->post_type . "_root";
								$pageRoot = $breadcrumbDetails[$root];
								$catTags = get_the_terms($post->ID,'blog_cat');
								if(is_array($headerMenus)||is_object($headerMenus)) {
								foreach ($headerMenus as $headerLink) {
								?>
								<li <?php if ((get_permalink($post->ID)==$headerLink->url) || $catTags[0]->name==$headerLink->title) { echo ' class="active" '; }?> ><a href="<?php echo $headerLink->url; ?>" title="<?php echo $headerLink->title; ?>" ><?php echo $headerLink->title; ?></a></li>
							<?php }  } 
							} else { 
								$mobHeaderMenus = get_menu('mobile_homepage_menu');
								$catTags = get_the_terms($post->ID,'blog_cat');
								foreach($mobHeaderMenus as $mobHeaderMenu) {
									$menuId = $mobHeaderMenu->ID;
									$menuUrl = (!empty($mobHeaderMenu->url)) ? $mobHeaderMenu->url : get_permalink($menuId);
									$menuTarget = ($mobHeaderMenu->target == "_blank") ? "target='_blank'" : '';
								  ?>
									  <li <?php if($mobHeaderMenu->object_id == $post->ID || $catTags[0]->name==$mobHeaderMenu->title ) { echo 'class="active"'; } ?>>
										<a class="menu__item" href="<?php echo $menuUrl; ?>">
										  	<span class="menu__item-name"><?php echo $mobHeaderMenu->title; ?></span>
										</a>
									  </li>
								<?php } 
							} ?>
							 <?php if(get_option('app_store')!='') { ?>
							<li><a href="<?php echo get_option('app_store'); ?>" class="app-store"><img src="<?php echo get_bloginfo('template_url');?>/img/app-store.png" alt="appstore"></a></li><?php } ?>
							</ul>
							
						</nav>
						
					</div>
					
				</div>
			</div>
		    <?php get_sidebar('search'); ?> 
		</header>