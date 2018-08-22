<?php

add_action('admin_menu', 'short_code');

function short_code() {
    $types = array( 'page','offer','banners', 'careers', 'blog', 'clients', 'news', 'partner', 'product','service','team');
    foreach ($types as $type){
        add_meta_box('shortCodes', 'Add Short Codes', 'short_codes', $type,'normal', 'high');
    }
}

function short_codes($post_id) {
    global $post;
    ?>
    <table class="shtCode" style="width:100%">
       
        <tr>
            <th style="text-align: left"><label for="image_left_aside">Short Codes</label></th>
            <th style="text-align: left"><p>Description</p></th>
        </tr>
         <tr>
            <td class="left heading">[info_tag]</td>
            <td  class="right description" ><p>Category Heading</p></td>
        </tr>
         <tr>
            <td class="left heading">[empty_line]</td>
            <td  class="right description" ><p>use this for break</p></td>
        </tr>
           <tr>
            <td class="left heading">[full_figure]</td>
            <td  class="right description" ><p>for full width image and content</p></td>
        </tr>
         </tr>
           <tr>
            <td class="left heading">[six_column]</td>
            <td  class="right description" ><p>for two seperate contents</p></td>
        </tr>
        <tr>
            <td class="left heading">[eight_column]</td>
            <td  class="right description" ><p>for eight column content</p></td>
        </tr>

        <tr>
            <td class="left heading">[figure]</td>
            <td  class="right description" ><p>Image of the content</p></td>
        </tr>
         <tr>
            <td class="left heading">[figcaption]</td>
            <td  class="right description" ><p>Figure Descriptions</p></td>
        </tr>
        <tr>
            <td class="left heading">[mobile_banner]</td>
            <td  class="right description" ><p>banner image for mobile site</p></td>
        </tr>
       
        <tr>
            <td class="left heading">[intro_content]</td>
            <td  class="right description" ><p>Heading of the content</p></td>
        </tr>
        
        <tr>
            <td class="left heading">[buttons]</td>
            <td  class="right description" ><p>Buttons</p></td>
        </tr>
        <tr>
            <td class="left heading">[accordion_section]</td>
            <td  class="right description" ><p>Group of accordion section</p></td>
        </tr>
        <tr>
            <td class="left heading">[accordion]</td>
            <td  class="right description" ><p>Single accordion section</p></td>
        </tr>
        <tr>
            <td class="left heading">[accordion_content]</td>
            <td  class="right description" ><p>Accordion inside content</p></td>
        </tr>
        <tr>
            <td class="left heading">[primary_button]</td>
            <td  class="right description" ><p>Primary button</p></td>
        </tr>
        <tr>
            <td class="left heading">[secondary_button]</td>
            <td  class="right description" ><p>Secondary button</p></td>
        </tr>
        
    </table>
    <?php
}
?>