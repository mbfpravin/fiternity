<?php
add_action('admin_menu', 'desc_link_options');

function desc_link_options() {
    $postTypeArrays = array('page','post','blog','event');
    foreach($postTypeArrays as $postTypeArray){
        add_meta_box('desc_link_options', 'Short description', 'link_options_design', $postTypeArray);
    }

}
function link_options_design($post_id) {
    global $post;
        $link_desc = get_post_meta($post->ID, 'link_desc', true);
    ?>
   

    <div id="groundId" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
                <tr> 
                    <td class="left"><label for="tax-order">Image credit Name</label></td>
                    <td  class="right">
                    <input type="textarea" name="link_desc" id="link_desc" value="<?php echo $link_desc; ?>" style="width: 100%;"></td>   
                    
                </tr> 
        </table>
    </div>   
    <?php
}

add_action('save_post', 'save_desc_link');

function save_desc_link($post_id) {
    global $post;

    get_post_type($post_id);

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;
            if(array_key_exists('link_desc', $_REQUEST)){  
                update_post_meta($post_id, 'link_desc', $_REQUEST['link_desc']);
            }
}
?>
