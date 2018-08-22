<?php
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
if(isset($_REQUEST['export']) && $_REQUEST['export'] == 'orders_list'):
    
    /*
     * #Export (Currency Orders)
     */
    $file_name = 'orderslist_'.date("M_d_Y_H_i").'.csv';
    $field_args = array(
        'customer_name'       => 'CUSTOMER NAME',
        'customer_email'       => 'CUSTOMER EMAIL',
        'customer_phone'       => 'CUSTOMER PHONE NUMBER',
        'event_name'       => 'EVENT NAME',
        'amount'       => 'AMOUNT(IN POUNDS)',
        'no_of_seats'       => 'No.OF.SEATS BOOKED',
        'charge_id'       => 'TRANSACTION ID',
        'currency'       => 'CURRENCY',
        'status'       => 'STATUS',
        'payment_date'       => 'DATE'
    );

    
    // Send Header info.
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename='".$file_name."'");
    
    $fh = fopen('php://output', 'w');
    
    // Send Export file columns.
    fputcsv($fh, $field_args);
    
    // Write Currency Columns.
    
    // Read from Database.
    $query = "SELECT * FROM ".$wpdb->prefix."bookings ORDER BY `payment_date` desc";
    $sql = $wpdb->get_results($query);
    $sql_count = count($sql);
    
    if($sql_count > 0):
            // Write to export file.
            foreach($sql as $x=>$row):
                if($row->amount !="Free") {
                    $row->amount = (float)$row->amount;
                    $row->amount = (float)($row->amount/100);
                } else {
                    $row->amount = 'Free';
                }
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

class Link_List_Table extends WP_List_Table
{
    function extra_tablenav( $which )
    {
        if ( $which == "top" ) {          
            echo "<h1>Stripe Orders</h1><p>Here are the list of Order details of booked Events:</p>";
        }
        if ( $which == "bottom" ){
            //echo"Hi, I'm after the table";
        }
    }   
    function get_columns()
    {
        return $columns= array(
        'col_customer_name'=>__('Customer name'),
        'col_customer_email'=>__('Customer Email'),
        'col_customer_phone'=>__('Customer telephone number'),
        'col_event_name'=>__('Event name'),
        'col_amount'=>__('Amount(&pound;)'),
        'col_no_of_seats'=>__('No.of seats booked'),
        'col_charge_id'=>__('Transaction ID'),
        'col_status'=>__('Status'),
        'col_payment_date'=>__('Date'),
        );
    }
    function prepare_items()
    {
        global $wpdb, $_wp_column_headers;
        $screen = get_current_screen();
        $query = "SELECT * FROM ". $wpdb->prefix ."bookings";

        /* -- Ordering parameters -- */
        //Parameters that are going to be used to order the result
        $orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'payment_date';
        $order = !empty($_GET["order"]) ? $_GET["order"] : 'DESC';
        if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY payment_date DESC'; }

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
    <br /><span><p>If you want to export the Stripe Orders list as a CSV file, Please click the export button below.</p><a href="?page=<?php echo $_REQUEST['page']?>&export=orders_list" id="export-orders_list" class="button" style="background-color:#0073aa; color:#fff;">Export</a></span>
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
                        
                        case "col_customer_name": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->customer_name).'</td>'; 
                        break;

                        case "col_customer_email": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->customer_email).'</td>'; 
                        break;

                        case "col_customer_phone": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->customer_phone).'</td>'; 
                        break;

                        case "col_event_name": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->event_name).'</td>'; 
                        break;

                        case "col_amount":
                            if($rec->amount!=0) {
                                echo '<td '.$attributes.'>'.($rec->amount/100).'</td>';
                            } else {
                                echo '<td '.$attributes.'>Free</td>';
                            }
                        break;

                        case "col_no_of_seats": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->no_of_seats).'</td>';
                        break;
                        
                        case "col_charge_id": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->charge_id).'</td>';
                        break;
                       
                        case "col_status": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->status).'</td>';
                        break;

                       /* case "col_stripe_token": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->stripe_token).'</td>';
                        break;*/

                        case "col_payment_date": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->payment_date).'</td>';
                        break;
                    }
                }
                echo'</tr>';
            }
        }
    }    

}

add_action('admin_menu', 'orders_list');

/*
    *** Admin menu
*/
function orders_list() {
    $page_title = 'Orders List';
    $menu_title = 'Orders List';
    $capability = 'moderate_comments';
    $menu_slug = 'orderslist';
    $function = 'orderResult';
    $icon_url = '';
    
    add_submenu_page('edit.php?post_type=event', 'Stripe Orders', 'Stripe Orders', 'manage_options', 'orderslist', 'orderResult');
}

function orderResult()
{
    $wp_list_table = new Link_List_Table();
    $wp_list_table->prepare_items();
    $wp_list_table->display();
}