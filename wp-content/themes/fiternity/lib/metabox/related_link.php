<?php
add_action('admin_menu', 'related_link_options');

function related_link_options() {
    $postTypeArrays = array('page','post','blog');
    foreach($postTypeArrays as $postTypeArray){
        add_meta_box('related_link_options', 'External link', 'related_link_options_design', $postTypeArray);
    }

}
function related_link_options_design($post_id) {
    global $post;
        $link_heading = get_post_meta($post->ID, 'link_heading', true);
        $rl_link_url = get_post_meta($post->ID, 'rl_link_url', true);
        $rl_link_target = get_post_meta($post->ID, 'rl_link_target', true);
    ?>
   

    <div id="groundDiv" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
                <tr> 
                    <td class="left"><label for="tax-order">Title</label></td>
                    <td  class="right">
                    <input type="textbox"  name="link_heading" id="link_heading" value="<?php echo $link_heading; ?>" style="width: 100%;"></td>      
                    
                    <td><label for="tax-order">Link Url</label></td>
                    <td><input type="text" name="rl_link_url"  value="<?php echo $rl_link_url; ?>" id="rl_link_url" style="width:170px;"/></td>
                    <td>
                       <select name="rl_link_target"><option value="_self" <?php if($rl_link_target=="_self"){ echo "selected='selected'"; } ?>>Self</option>
                    <option value="_blank" <?php if($rl_link_target =="_blank"){ echo "selected='selected'"; } ?>>New tab</option></select>     
                    </td>
                </tr> 
        </table>
    </div>   
    <?php
}

add_action('save_post', 'save_related_link');

function save_related_link($post_id) {
    global $post;

    get_post_type($post_id);

    //if (get_post_type($post_id) == 'project_post') {
        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;
            if(array_key_exists('link_heading', $_REQUEST)){  
            update_post_meta($post_id, 'link_heading', $_REQUEST['link_heading']);
            }
            if(array_key_exists('rl_link_url', $_REQUEST)){   
            update_post_meta($post_id, 'rl_link_url', $_REQUEST['rl_link_url']);
            }
            if(array_key_exists('rl_link_target', $_REQUEST)){
            update_post_meta($post_id, 'rl_link_target', $_REQUEST['rl_link_target']);
            }

    //}
}
?>
