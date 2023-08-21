<?php
/*
Plugin Name: WP_3DProductAR
Description: Transform your WooCommerce store by effortlessly incorporating 3D models, revolutionizing how customers engage with and explore your products.
Version: 1.0
Author: Ezhilarasan and Durga
Author URI: https://emote3d.com/
*/

if(!defined('ABSPATH')){
    echo 'What are you doing here';
    exit;
}

require_once('db_conn.php');

register_activation_hook(__FILE__, 'init_db_dashboard_table_connction');

function custom_dashboard_page() {
    add_menu_page(
        'WP_3DProductAR Page',
        'WP_3DProductAR',
        'manage_options',
        'custom-dashboard-slug',
        'wp_3dproductar_products_page',
        'dashicons-art', 
        20
    );
}
add_action('admin_menu', 'custom_dashboard_page');


function enqueue_WP_3DProductAR_style_script() {
    wp_enqueue_style('plugin_style', plugin_dir_url(__FILE__) . '/css/style.css', array(), 1);
    wp_enqueue_script('plugin_script', plugin_dir_url(__FILE__) . '/js/script.js', array(), 1, true);
}
add_action('admin_enqueue_scripts', 'enqueue_WP_3DProductAR_style_script');


function wp_3dproductar_products_page() {
    echo '<div class="plugin_head">
    <h1 >WP 3DProductAR Plugin</h1>
    <p>Transform your WooCommerce store by effortlessly incorporating 3D models, revolutionizing how customers engage with and explore your products.</p>';
    
    
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        echo 'Yes, WooCommerce is enabled'.'<br>';
        display_woocommerce_products();
      
    } else {
        echo 'WooCommerce is NOT enabled!';
    }
    
}


function display_woocommerce_products() {

    $products = wc_get_products(array(
        'status' => 'publish', 
        'limit' => -1,         
        'orderby' => 'ID',    
        'order' => 'ASC',      
    ));
    $product_data = '';
    $status = '-';
    $product_no = 1;
    $i = 0;
    $product_data .= '
    <div class="emote_plugin_product">
    <table class="emote_product_table">
    <thead class="emote_plugin_product_head">
    <tr>
      <th>S.No</th>
      <th>Product Name</th>
      <th>SKU</th>
      <th>Upload Your 3D Model</th>
      <th>Status</th>
    </tr>
    </thead>';
    foreach ($products as $product) {
        $product_data .= '<tr id="test-id-' . $i . '">';
        $product_data .= '<td>' . $product_no++ . '</td>';
        $product_data .= '<td>' . $product->get_name() . '</td>';
        $product_data .= '<td>' . $product->get_sku() . '</td>';
        $product_data .= '<td>' . '<button class="upload_glb_btn">Upload glb</button></td>';
        $product_data .= '<td>' . $status . '</td>';
        $product_data .= '</tr>';
        echo '<br>';
        $i++;
    }
    $product_data .= '</table> </div>';
    echo $product_data;
}


