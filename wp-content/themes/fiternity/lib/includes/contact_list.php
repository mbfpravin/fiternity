<?php
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
if(isset($_REQUEST['export']) && $_REQUEST['export'] == 'contact_list'):
    
    /*
     * #Export (Currency Orders)
     */
    $file_name = 'contactlist_'.date("M_d_Y_H_i").'.csv';
    $field_args = array(
        'name'        => 'NAME',
        'email'        => 'EMAIL',
        'telephone'        => 'TELEPHONE',
        'message'        => 'MESSAGE',
        'posted_date'       => 'DATE'
    );

    
    // Send Header info.
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename='".$file_name."'");
    
    $fh = fopen('php://output', 'w');
    
    // Send Export file columns.
    fputcsv($fh, $field_args);
    
    // Write Currency Columns.
    
    // Read from Database.
    $query = "SELECT * FROM ".$wpdb->prefix."contact ORDER BY `posted_date` desc";
    $sql = $wpdb->get_results($query);
    $sql_count = count($sql);
    
    if($sql_count > 0):
            // Write to export file.
            foreach($sql as $x=>$row):
                $line = array();
                foreach($field_args as $column_name=>$field):
                    $line[] = $row->$column_name;
                endforeach;
                fputcsv($fh, $line);
            endforeach;
    else:
        fputcsv($fh, array('No results found!.'));
    endif;
    exit;
endif; /** Export - End **/
class Link_Contact_List_Table extends WP_List_Table
{
    function extra_tablenav( $which )
    {
        if ( $which == "top" ) {          
            echo "<h1>Contact Enquiries</h1><p>Here are the list of Contact Enquiries:</p>";
        }
        if ( $which == "bottom" ){
            //echo"Hi, I'm after the table";
        }
    }   
    function get_columns()
    {
        return $columns= array(
        'col_name'=>__('Name'),
        'col_email'=>__('Email'),
        'col_telephone'=>__('Telephone Number'),
        'col_message'=>__('Message'),
        'col_posted_date'=>__('Date')
        );
    }
    function prepare_items()
    {
        global $wpdb, $_wp_column_headers;
        $screen = get_current_screen();
        $query = "SELECT * FROM ". $wpdb->prefix ."contact";

        /* -- Ordering parameters -- */
        //Parameters that are going to be used to order the result
        $orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'DESC';
        $order = !empty($_GET["order"]) ? $_GET["order"] : 'posted_date';
        if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$order.' '.$orderby; }

        /* -- Pagination parameters -- */
        //Number of elements in your table?
        $totalitems = $wpdb->query($query); //return the total number of affected rows
        //How many to display per page?
        $perpage = 30;
        //Which page is this?
        $paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
        //Page Number
        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
        //How many pages do we have in total?
        $totalpages = ceil($totalitems/$perpage);
        //adjust the query to take pagination into account
        if(!empty($paged) && !empty($perpage)){
        $offset=($paged-1)*$perpage;
        $query.=' LIMIT '.(int)$offset.','.(int)$perpage;
        }

        /* -- Register the pagination -- */
        $this->set_pagination_args( array(
        "total_items" => $totalitems,
        "total_pages" => $totalpages,
        "per_page" => $perpage,
        ) );
        //The pagination links are automatically built according to those parameters

        /* — Register the Columns — */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        /* -- Fetch the items -- */
        $this->items = $wpdb->get_results($query);
    }

    function display_rows()
    {
 ?>
    <br /><span><p>If you want to export the Contact Enquiries as a CSV file, Please click the export button below.</p><a href="?page=<?php echo $_REQUEST['page']?>&export=contact_list" id="export-contact_list" class="button" style="background-color:#0073aa; color:#fff;">Export</a></span>
    <?php       
    $records = $this->items;
       list( $columns, $hidden ) = $this->get_column_info();
        //Loop for each record
        if(!empty($records)) {
            foreach($records as $rec) {
                echo '<tr id="record_'.$rec->id.'">';
                foreach ( $columns as $column_name => $column_display_name ) {
                    $class = "class='$column_name column-$column_name'";
                    $style = "";
                    if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';
                        $attributes = $class . $style;
                        $editlink  = '/wp-admin/link.php?action=edit&id='.(int)$rec->id;
                    
                    //Display the cell
                    switch ( $column_name ) {
                        
                        case "col_name": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->name).'</td>';
                        break;

                        case "col_email": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->email).'</td>'; 
                        break;

                        case "col_telephone": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->telephone).'</td>';
                        break;

                        case "col_message": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->message).'</td>';
                        break;

                        case "col_posted_date": 
                            echo '<td '.$attributes.'>'.$rec->posted_date.'</td>';
                        break;
                    }
                }
                echo'</tr>';
            }
        }
    }    

}

add_action('admin_menu', 'contact_list');

/*
    *** Admin menu
*/
function contact_list() {
    $page_title = 'Contact List';
    $menu_title = 'Contact List';
    $capability = 'moderate_comments';
    $menu_slug = 'contactlist';
    $function = 'contactResult';
    $icon_url = '';
    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);
}

function contactResult()
{
    $wp_list_table = new Link_Contact_List_Table();
    $wp_list_table->prepare_items();
    $wp_list_table->display();
}