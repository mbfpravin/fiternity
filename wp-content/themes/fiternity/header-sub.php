<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Fiternity</title>
	  <script src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.8.3.js"></script>
  <style>
		body{
			background-color: #fff;
		}  
		.render-blk{ opacity:0; }
	</style>
	<script>
		var cssArr = ['css/app.css','style.css'];
		for(var i = 0; i < cssArr.length; i++) {
			var link = document.createElement('link');
			link.setAttribute('rel', 'stylesheet');
			link.setAttribute('href', '<?php echo TMPL_URL."/"; ?>'+cssArr[i]);
			document.getElementsByTagName('head')[0].appendChild(link);
		}
	</script>
	<noscript>
	<style media="screen">
	  .render-blk{ opacity: 1; }  
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
	<header>
		<?php
		$subpageLogo = get_option('sub_header_logo');
		?>
		<div class="container">
		  <div class="row">
			<div class="col-3">
			<?php if($subpageLogo!='') { ?>
			  	<a href="<?php echo get_bloginfo('url'); ?>/" class="logo"><img src="<?php echo $subpageLogo; ?>" alt="logo"></a>
			 <?php } else { ?>
			 	<a href="<?php echo get_bloginfo('url'); ?>/" class="logo"><img src="<?php echo get_bloginfo('template_url');?>/img/subpageLogo.png" alt="logo"></a>
			 <?php } ?>
			</div>
			<div class="col-8">
				<div class="menu-toggle">
					<div class="one"></div>
					<div class="two"></div>
					<div class="three"></div>
				</div>
			  <?php $headerMenus = get_menu('subpage_menu'); ?>
			  <nav class="menu menu--ama">
				<ul>
				  <?php 
				  foreach($headerMenus as $headerMenu) { 
					$menuId = $headerMenu->ID;
					$menuUrl = (!empty($headerMenu->url)) ? $headerMenu->url : get_permalink($menuId);
					$menuTarget = ($headerMenu->target == "_blank") ? "target='_blank'" : '';
				  ?>
					<li <?php if($headerMenu->object_id == $post->ID) { echo 'class=""'; } ?>>
						<a class="menu__item" href="<?php echo $menuUrl; ?>">
						  	<span class="menu__item-name"><?php echo $headerMenu->title; ?></span>
						</a>
					</li>
				  <?php } ?>
				</ul>
			  </nav>
			</div>
			
		  </div>
		</div>
		<?php get_sidebar('search'); ?>
			</header>
