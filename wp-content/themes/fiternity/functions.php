<?php
if (!defined('TMPL_URL')) {
	define('TMPL_URL', get_template_directory_uri());
}

add_action('init', 'init_custom_load');

function init_custom_load(){
	if(is_admin()) {
		wp_enqueue_style('admin_css', TMPL_URL.'/lib/css/admin_css.css', false, '1.0', 'all');
		wp_enqueue_style('font-awesome.min', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
		wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
    }
}
show_admin_bar(false);

/******
For post type:admin-config
******/

require_once(TEMPLATEPATH . "/lib/admin-config.php");

/********
Featured Image
********/
add_theme_support('post-thumbnails');
/*******
Menu Backend
*******/
add_theme_support( 'menus' );
/*******
For Excerpt
*******/
add_post_type_support('page', 'excerpt');

@ini_set( 'upload_max_size' , '256M' );
@ini_set( 'post_max_size', '256M');
@ini_set( 'max_execution_time', '900' );

function se_remove_styles() {
    wp_deregister_style( 'events-manager');
}
add_action( 'wp_print_styles', 'se_remove_styles', 99 );

/*Get logo at center and count*/
function dropDownMenu($menu_type) {
	global $post;
	$menu_args = array(
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'post_type' => 'nav_menu_item',
		'post_status' => 'publish',
		'output' => ARRAY_A,
		'output_key' => 'menu_order',
		'nopaging' => true,
		'update_post_term_cache' => false
	);
	$main_menu_array = wp_get_nav_menu_items($menu_type, $menu_args);

	$tot_main_menu = count($main_menu_array);
	if ($tot_main_menu != 0) {
		foreach ($main_menu_array as $key => $home_menu) {
			$parent_menu = $home_menu->menu_item_parent;
			$menu_title = $home_menu->title;
			$menu_id = $home_menu->ID;
			$menu_url = (!empty($home_menu->url)) ? $home_menu->url : get_permalink($menu_id);
			$menu_target = ($home_menu->target == "_blank") ? "target='_blank'" : '';
			$menu_parent_id = $home_menu->menu_item_parent;
			if ($parent_menu == 0) {
			  
			  
				?>
				<li <?php if($home_menu->object_id == $post->ID) { echo 'class="active"'; } ?>>
					<a href="<?php print $menu_url; ?>" title="<?php print $menu_title; ?>" <?php print $menu_target; ?>>
					<?php print $menu_title; ?>
					</a>
					<?php
					$menuid =($_SERVER['HTTP_HOST'] == "192.168.3.102" ) ? 806 : 401;
					customSubmenu($menu_id, $main_menu_array, $menu_title);     ?>
				</li>
				<?php
				
			}
		}
	}
}
function custom_label_events_cat( $location_post_type ) {
    $location_post_type = array('label' => __('Event as','events-manager'),
      );
    return $location_post_type;
}
 
add_filter( 'taxonomy_labels_event-categories','custom_label_events_cat');
function customSubmenu($menuVal, $menu_items, $current_menu_title) {
  global $post;
	$submenu_count = 0;
	foreach ($menu_items as $item) {
		if ($item->menu_item_parent == $menuVal) {
			$submenu_count++;
		}
	}
	if ($submenu_count != 0) {
		print '<ul>';
		foreach ($menu_items as $subitem) {
			$subtarget = "";
			if ($subitem->menu_item_parent == $menuVal) {
				if ($subitem->target == "_blank") {
					$subtarget = "target='_blank'";
				}
				?>
				<li <?php if ($post->ID==$subitem->object_id) { echo ' class="active" '; }?> >
					<a href="<?php echo $subitem->url; ?>" title="<?php echo $subitem->title; ?>" <?php echo $subtarget; ?>>
				<?php echo $subitem->title; ?>
					</a>
					 <?php
						// customSecSubmenu($subitem->ID, $menu_items, $subitem->title);
					?>
				</li> <?php
			}
		}
		print "</ul>";
	}
}
/********************
For Multi post 
********************/
if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(array(
       'label' => 'Icon Image (357 × 288) ',
       'id' => 'blogicon',
       'post_type' =>  'blog'
       )
   );
}
/********************s
To get all menus
********************/
function get_menu($menuName){
   $mainMenuArgs = array(
   'order' => 'ASC', 
   'post_type' => 'nav_menu_item', 
   'post_status' => 'publish',
   'output' => ARRAY_A,
   'output_key' => 'menu_order', 
   'nopaging' => true,
   'update_post_term_cache' => false,
   'menu_item_parent' => 0
   );
   $menuItems = wp_get_nav_menu_items($menuName, $mainMenuArgs); 
   return $menuItems;
}

if (class_exists('MultiPostThumbnails')) {
	$postTypes = array('event','blog');
	foreach($postTypes as $postType)
	{
		new MultiPostThumbnails(array(
			'label' => 'Banner Image',
			'id' => 'bannerimage',
			'post_type' => $postType
			)
		);
	}
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}



function slid_client ($classes, $item) {

      $aboutSubPage = get_post($postId);
      $partAboutArgs=array(
        'orderby' => 'post_date',
        'order'   => 'ASC',
        'post_type'=> 'client',
        'post_status'=>'publish',
        'numberposts'=>-1
      );
      $partnerAboutPages=get_posts($partAboutArgs);
      $linkUrl = get_post_meta($aboutSubPage->ID, 'rl_link_url', true);
      $linkHeading = get_post_meta($aboutSubPage->ID, 'link_heading', true);
      $linkTarget = get_post_meta($aboutSubPage->ID, 'rl_link_target', true);
      ?>
      <div class="partner-section">
        <div class="container">
          <div class="col-6 center-block">
            <div class="title">
              <span class="tile-menu"><?php echo $aboutSubPage->post_title; ?></span>
               <?php echo apply_filters('the_content',$aboutSubPage->post_content  ); ?>
            </div>
          </div>
          <div class="brand-slider">
            <?php 
            foreach ($partnerAboutPages as $partnerAboutPage) { 
            $featImage = wp_get_attachment_url(get_post_thumbnail_id($partnerAboutPage->ID) );
            ?>
              <div>
                <img src="<?php echo $featImage; ?>" alt="images">
              </div>
              <?php } ?>
          </div>
          <?php if($linkHeading != "" && $linkUrl!='') { ?>
            <div class="alignBtn">
              <a href="<?php echo $linkUrl; ?>" target="<?php echo $linkTarget; ?>" class="button"><?php echo $linkHeading; ?></a>
            </div>
          <?php } ?>
        </div>
      </div>
    
<?php }
add_shortcode('slid_client', 'slid_client');

/********
Remove default image width and height
*********/
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
  $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
  return $html;
}

add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
   $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
   return $html;
}

/*******
For empty paragraph
*******/
function shortcode_empty_paragraph_fix_tag($content) {
	$array = array(
		'<p>[' => '[',
		']</p>' => ']',
		'<p></p>' => '',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

/*****
Short codes
*****/
  function break_tag( $atts, $content = null ) {
     $content = preg_replace('#^<\/p>|<p>$#', '', $content);
     // $content=shortcode_empty_paragraph_fix_tag($content);
     return '<br/>';
  }
  add_shortcode('break_tag', 'break_tag');

function empty_line($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    // $content = shortcode_empty_paragraph_fix($content);
    return '<div class="stromp">&nbsp;</div>';
}
add_shortcode('empty_line', 'empty_line');

function full_figure( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '
          <div class="col-8"><figure class="content-image center-block" style="width: 1170px;">'.do_shortcode($content).'</figure></div>';
}
add_shortcode('full_figure', 'full_figure');


function figure( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figure class="content-image">'.do_shortcode($content).'</figure>';
}
add_shortcode('figure', 'figure');
function caption( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figure class="content-image"><figure>'.do_shortcode($content).'</figure></figure>';
}
add_shortcode('caption', 'caption');
function mobile_banner( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   $img_owner = $atts['img_owner'];
   $img_src = $atts['img_src'];
   
   return '<div class="mobile-banner">'.do_shortcode($content).'<p>Image credit:<a href="'.$img_src.'">'.$img_owner.'</a></p></div>';
}
add_shortcode('mobile_banner', 'mobile_banner');

function figcaption( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figcaption>'.do_shortcode($content).'</figcaption>';
}
add_shortcode('figcaption', 'figcaption');

function intro_content( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="intro-content">'.do_shortcode($content).'</div>';
}
add_shortcode('intro_content', 'intro_content');

function info_tag( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<span class="infotag">'.do_shortcode($content).'</span>';
}
add_shortcode('info_tag', 'info_tag');

function buttons( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="dbl-button">'.do_shortcode($content).'</div>';
}
add_shortcode('buttons', 'buttons');

function accordion_section( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion-section">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion_section', 'accordion_section');

function accordion( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion', 'accordion');

function accordion_content( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion-content">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion_content', 'accordion_content');

function primary_button( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   $link = $atts["url"];
   return '<a href="'.$link.'" class="button">'.do_shortcode($content).'</a>';
}
add_shortcode('primary_button', 'primary_button');

function secondary_button( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   $link = $atts["url"];
   return '<a href="'.$link.'" class="button button-secondary">'.do_shortcode($content).'</a>';
}
add_shortcode('secondary_button', 'secondary_button');


function full_width_content( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="row"><div class="col-8">'.do_shortcode($content).'</div></div>';
}
add_shortcode('full_width_content', 'full_width_content');



function eight_column( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-8">'.do_shortcode($content).'</div>';
}
add_shortcode('eight_column', 'eight_column');

function event_title( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-6 center-block"><div class="title"><span class="tile-menu">'.do_shortcode($content).'</span></div></div>';
}
add_shortcode('event_title', 'event_title');


function six_column( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-6">'.do_shortcode($content).'</div>';
}
add_shortcode('six_column', 'six_column');

function menu_fix_on_search_page( $query ) {
    if(is_search()){
        $query->set( 'post_type', array(
         'blog','event','page','post','nav_menu_item'
            ));
          return $query;
    }
}
if( !is_admin() ) { add_filter( 'pre_get_posts', 'menu_fix_on_search_page' ); }

function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..  
    return false;
}
function body_cls($classes) {
	// $subPage = is_front_page()?'':'subpagheader';
    $classes[] = $subPage;
    return $classes;
}

add_filter('body_class', 'body_cls');

add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($input) {
$input = str_replace("type='text/javascript' ", '', $input);
return str_replace("'", '"', $input);
}


function filterEventOutputCondition($replacement, $condition, $match, $EM_Event){
    if (is_object($EM_Event)) {
 
        switch ($condition) {
 
            // replace LF with HTML line breaks
            case 'nl2br':
                // remove conditional
                $replacement = preg_replace('/\{\/?nl2br\}/', '', $match);
                // process any placeholders and replace LF
                $replacement = nl2br($EM_Event->output($replacement));
                break;
 
            // #_ATT{Website}
            case 'has_external_link':
                if (is_array($EM_Event->event_attributes) && !empty($EM_Event->event_attributes['external_link']))
                    $replacement = preg_replace('/\{\/?has_external_link\}/', '', $match);
                else
                    $replacement = '';
                break;

                case 'has_no_external_link':
                if (is_array($EM_Event->event_attributes) && empty($EM_Event->event_attributes['external_link']))
                    $replacement = preg_replace('/\{\/?has_no_external_link\}/', '', $match);
                else
                    $replacement = '';
                break;
 
        }
 
    }
 
    return $replacement;
}
 
add_filter('em_event_output_condition', 'filterEventOutputCondition', 10, 4);