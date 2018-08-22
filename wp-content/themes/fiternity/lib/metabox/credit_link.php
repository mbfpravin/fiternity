<?php
add_action('admin_menu', 'credit_link_options');

function credit_link_options() {
    $postTypeArrays = array('page','post','blog','event');
    foreach($postTypeArrays as $postTypeArray){
        add_meta_box('credit_link_options', 'Credit link options', 'link_options_design', $postTypeArray);
    }

}
function link_options_design($post_id) {
    global $post;
        $link_name = get_post_meta($post->ID, 'link_name', true);
        $link_url = get_post_meta($post->ID, 'link_url', true);
        $link_target = get_post_meta($post->ID, 'link_target', true);
    ?>
   

    <div id="groundId" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
                <tr> 
                    <td class="left"><label for="tax-order">Image credit Name</label></td>
                    <td  class="right">
                    <input type="textbox" name="link_name" id="link_name" value="<?php echo $link_name; ?>" style="width: 100%;"></td>      
                    
                    <td><label for="tax-order">Owner Link Url</label></td>
                    <td><input type="text" name="link_url"  value="<?php echo $link_url; ?>" id="link_url" style="width:170px;"/></td>
                    <td>
                       <select name="link_target"><option value="_self" <?php if($link_target=="_self"){ echo "selected='selected'"; } ?>>Self</option>
                    <option value="_blank" <?php if($link_target =="_blank"){ echo "selected='selected'"; } ?>>New tab</option></select>     
                    </td>
                </tr> 
        </table>
    </div>   
    <?php
}

add_action('save_post', 'save_credit_link');

function save_credit_link($post_id) {
    global $post;

    get_post_type($post_id);

    //if (get_post_type($post_id) == 'project_post') {
        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;
            if(array_key_exists('link_name', $_REQUEST)){  
            update_post_meta($post_id, 'link_name', $_REQUEST['link_name']);
            }
            if(array_key_exists('link_url', $_REQUEST)){   
            update_post_meta($post_id, 'link_url', $_REQUEST['link_url']);
            }
            if(array_key_exists('link_target', $_REQUEST)){
            update_post_meta($post_id, 'link_target', $_REQUEST['link_target']);
            }

    //}
}
?>
