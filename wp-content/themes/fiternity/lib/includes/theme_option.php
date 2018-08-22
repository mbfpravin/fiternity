<?php
add_action('admin_menu', 'theme_menu');

function theme_menu() {
    add_menu_page('Fiternity Theme Options', 'Theme Options', 'administrator', 'options_page', 'theme_options_page');
}
function theme_options_page() {
    if (isset($_REQUEST['submit'])) {
         update_option('contact_us_email', $_REQUEST['contact_us_email']);
         update_option('booking_order_email', $_REQUEST['booking_order_email']);
         update_option('facebook', $_REQUEST['facebook']);
         update_option('instagram', $_REQUEST['instagram']);
         update_option('default_image', $_REQUEST['default_image']);
         update_option('app_store', $_REQUEST['app_store']);
         update_option('play_store', $_REQUEST['play_store']);
         update_option('twitter', $_REQUEST['twitter']);
         update_option('header_watermark', $_REQUEST['header_watermark']);
         update_option('header_logo', $_REQUEST['header_logo']);
         update_option('sub_header_logo', $_REQUEST['sub_header_logo']);
         update_option('header_page_intro', $_REQUEST['header_page_intro']);
         update_option('app_store_link', $_REQUEST['app_store_link']);
         $updated = 1;
}
?>
<?php if ($updated == 1) { ?>
        <div class="updated" style="margin-top: 10px;"><p>Details Updated Successfully</p></div>
    <?php } ?>
<div id="usual2" class="usual">
        <form name="options" id="options" action="" method="post">
            <h1>Fiternity Theme Options</h1>
            <h2>General Settings</h2>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Contact us email</div>
                    <div class="field"><input type="text" name="contact_us_email" id="contact_us_email" value="<?php echo get_option('contact_us_email'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Booking order email</div>
                    <div class="field"><input type="text" name="booking_order_email" id="booking_order_email" value="<?php echo get_option('booking_order_email'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Facebook:</div>
                    <div class="field"><input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Instagram:</div>
                    <div class="field"><input type="text" name="instagram" id="instagram" value="<?php echo get_option('instagram'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Twitter:</div>
                    <div class="field"><input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">App store link:</div>
                    <div class="field"><input type="text" name="app_store" id="app_store" value="<?php echo get_option('app_store'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Play store link:</div>
                    <div class="field"><input type="text" name="play_store" id="play_store" value="<?php echo get_option('play_store'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Default image url:</div>
                    <div class="field"><input type="text" name="default_image" id="default_image" value="<?php echo get_option('default_image'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Header watermark text:</div>
                    <div class="field"><input type="text" name="header_watermark" id="header_watermark" value="<?php echo get_option('header_watermark'); ?>"  />
                    </div><br />
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Header Logo URL:</div>
                    <div class="field"><input type="text" name="header_logo" id="header_logo" value="<?php echo get_option('header_logo'); ?>"  />
                    </div><br />
                </div>
            </div>
           <!--  <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Subpage Header Logo URL:</div>
                    <div class="field"><input type="text" name="sub_header_logo" id="sub_header_logo" value="<?php echo get_option('sub_header_logo'); ?>"  />
                    </div><br />
                </div>
            </div> -->
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Header page intro:</div>
                    <div class="field">
                        <textarea name="header_page_intro" id="header_page_intro"  value="" style ="width: 50%;"><?php echo get_option('header_page_intro'); ?></textarea>
                    </div>
                </div>
            </div>
            <div id="tabs1" class="tab">
               <div class="contaniner">
                    <div class="label">Header App store link:</div>
                    <div class="field"><input type="text" name="app_store_link" id="app_store_link" value="<?php echo get_option('app_store_link'); ?>"  />
                    </div><br />
                </div>
            </div>
            <br style="clear:both;" />
            <input type="submit" class="btn" name="submit" value="Save Options" style="margin-top:20px;" />
        </form>
     </div>
     <script>
        jQuery("#usual2 ul").idTabs();
    </script>
    <?php } ?>
