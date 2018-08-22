<?php
add_action('admin_menu', 'template_metabox_options');

function template_metabox_options() {
    $types = array('blog');
foreach( $types as $type ) {
      add_meta_box('template_metabox_options', 'Additional options', 'template_metabox_options_design', $type);
}

}
function template_metabox_options_design($post_id) {
    global $post;
        $showInHome = get_post_meta($post->ID, 'show_in_home', true);
        $squareBox = get_post_meta($post->ID, 'square_box_style', true);
        $titleTag = get_post_meta($post->ID, 'title_tag', true);
    ?>
    <div id="groundDiv" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
                <tr> 
                    <td class="left"><label for="tax-order">Show this blog in Home page?</label></td>
                    <td  class="right">
                        <select name="show_in_home">
                            <option value="no" <?php if($showInHome == 'no') { echo 'selected'; } ?>>No</option>
                            <option value="yes" <?php if($showInHome == 'yes') { echo 'selected'; } ?>>Yes</option>
                        </select>
                    </td>
                </tr>
                <tr> 
                    <td class="left"><label for="tax-order">Square box style</label></td>
                    <td  class="right">
                        <select name="square_box_style">
                            <option value="">Select</option>
                            <option value="red-border" <?php if($squareBox == 'red-border') { echo 'selected'; } ?>>Red border</option>
                            <option value="yellow-border" <?php if($squareBox == 'yellow-border') { echo 'selected'; } ?>>Yellow border</option>
                            <option value="yellow-overlay" <?php if($squareBox == 'yellow-overlay') { echo 'selected'; } ?>>Yellow overlay</option>
                            <option value="red-overlay" <?php if($squareBox == 'red-overlay') { echo 'selected'; } ?>>Red overlay</option>
                        </select>
                    </td>
                </tr>
                 <tr> 
                    <td class="left"><label for="tax-order">Title tag</label></td>
                    <td  class="right">
                        <select name="title_tag">
                            <option value="">Select</option>
                            <option value="infotag" <?php if($titleTag == 'infotag') { echo 'selected'; } ?>>Red colur tag</option>
                            <option value="newtag" <?php if($titleTag == 'newtag') { echo 'selected'; } ?>>Yellow colour tag</option>
                            <option value="info-redtag" <?php if($titleTag == 'info-redtag') { echo 'selected'; } ?>>Red Colour tag with Background</option>
                        </select>
                    </td>
                </tr>
        </table>
    </div>   
    <?php
}

add_action('save_post', 'save_template_metabox');

function save_template_metabox($post_id) {
    global $post;

    get_post_type($post_id);

    //if (get_post_type($post_id) == 'project_post') {
        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;  
            
             if(array_key_exists('show_in_home', $_REQUEST))
            {
                update_post_meta($post_id, 'show_in_home', $_REQUEST['show_in_home']);
            }
             if(array_key_exists('square_box_style', $_REQUEST))
            {
                update_post_meta($post_id, 'square_box_style', $_REQUEST['square_box_style']);
            }
             if(array_key_exists('title_tag', $_REQUEST))
            {
                update_post_meta($post_id, 'title_tag', $_REQUEST['title_tag']);
            }
            

    //}
}
?>
