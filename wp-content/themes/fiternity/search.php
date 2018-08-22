<?php
/*
Template Name: Search Page
*/
get_header('sub'); 
global $query_string;
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID) );
$defaultImage = get_option('default_image');
if($featImage!='') {
  $image = $featImage;
} else {
  $image = $defaultImage;
}
$s=get_search_query();
$args = array(
    's' =>$s
);
$searchResults = new WP_Query( $args );
?>
<section class="subBanner">
	<div class="container">
		<div class="parallaxBg subBanner-bg" style="background-image: url(<?php echo $defaultImage; ?>);"></div>
	</div>
	<!-- <div class="watermark">Search Results</div> -->
</section>
<div class="container">
	<div class="row">
		<div class="col-8 generic-content">
			<h1>Search Results</h1>
			<?php if(is_array($searchResults->posts) && count($searchResults->posts) > 0) { ?>
			<p>Results related to your search as follows:</p>
			<ul>
				<?php 
				
					foreach($searchResults->posts as $searchList){
						$searchFeatImage = wp_get_attachment_url(get_post_thumbnail_id($searchList->ID) );
						if($searchList->post_type!='nav_menu_item') {
						?>
							<li><a href="<?php echo get_permalink($searchList->ID); ?>"><?php echo $searchList->post_title; ?></a></li>
						<?php 
						}
					}
				?>
			</ul>
			<?php
			} else { 
				echo '<h4>Sorry! No results found.</h4>';
			} 
			?>
		</div>
	</div>	
</div>
<?php get_footer(); ?>