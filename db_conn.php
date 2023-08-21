<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

function init_db_dashboard_table_connction() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $dashboard_table = $wpdb->prefix . '3dproductar_dashboard_data';
    
    $sql = "CREATE TABLE $dashboard_table (
        id INT NOT NULL AUTO_INCREMENT,
        file_name VARCHAR(255) NOT NULL,
        template_id INT NOT NULL,
        created_date DATETIME NOT NULL,
        modified_date DATETIME NOT NULL,
        status VARCHAR(20) NOT NULL,    
        PRIMARY KEY (id)
    ) $charset_collate;";
    
   
    if ($wpdb->get_var("SHOW TABLES LIKE '$dashboard_table'") != $dashboard_table) {
        dbDelta($sql);
    }
}