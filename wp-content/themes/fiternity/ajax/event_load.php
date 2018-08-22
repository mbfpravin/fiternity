<?php
global $_POST;
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0].'wp-load.php';
$taxonomy = "event-categories";
$noOfPost = 6;
$eventCategoryId = $_POST['categoryId'];
$eventExcludePostArray = $_POST['postIdArray'];
$today = time();
$eventCollections = EM_Events::get(array(
 "orderby"=>"event_start_date", 
 "order"=>"DESC",
 'numberposts' => $noOfPost,
 // 'post__not_in' => $eventExcludePostArray,
 'meta_query' => array(
        array(
            'key' => 'event_end_date',
            'value' => $today,
            'compare' => '>=',
        )
    ),
));
/*
if($price!='' || $price!=0) {
   $price = number_format($price, 2, '.', '');
   $pricetag='<span> &#163;<?php echo $price; ?></span>' 
}else{
  $pricetag='<span><strong>Free</strong></span>'

}*/

$eventsCount = EM_Events::count();
foreach ($eventCollections as $eventCollections) {
  if(in_array($eventCollections->ID,$eventExcludePostArray)) {
    continue;
  }
    $featImage = wp_get_attachment_url(get_post_thumbnail_id($eventCollections->ID) );
    $startDate = $eventCollections->event_start_date;
    $endDate = $eventCollections->event_end_date;
    $eventCategory = get_the_terms( $eventCollections->ID, 'event-categories' );
    $tickets = $eventCollections->get_tickets();
    $seats = $eventCollections->get_spaces();
    foreach( $tickets->tickets as $EM_Ticket ){
                $price = $EM_Ticket->get_price();                 
    }
    $price = (float)$price;
     $price_cont = ($price!='' || $price!=0)?"<span> &#163;".$price ."</span>":"<span><strong>Free</strong></span>";

    echo    '<div class="slider-blk col-4 '.$eventCategoryId.' event_col" data-id="'.$eventCollections->ID.'">
              <a href="'.get_permalink($eventCollections->ID).'" ">
                      <img src="'.$featImage.'" alt="slider"></a>
                        <div class="whitebox">
                      <span class="post-date"><strong>'. date('d F', strtotime($startDate)).'
                          </strong>'. date('Y', strtotime($startDate)).'</span>
                        <h4>'.$eventCollections->post_title.'</h4>
                        <h3>'.$eventCategory[0]->name.'</h3>
                        <div class="price-detail">'.$price_cont.'
                        <a href="'.get_permalink($eventCollections->ID).'" class="button button-big">Book now</a></div>
                      </div>
             </div>';
  
}
?>