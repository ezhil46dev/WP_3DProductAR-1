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
require_once('single_product_edit_page.php');

register_activation_hook(__FILE__, 'init_db_dashboard_table_connction');

function custom_dashboard_page() {
    add_menu_page(
        'WP_3DProductAR Page',
        'WP_3DProductAR',
        'manage_options',
        'ar3d-listing',
        'wp_3dproductar_products_page',
        'dashicons-art', 
        20
    );
    add_submenu_page(
        'Single Product Edit Page',
        'single_product_edit',
        'Hidden Submenu',
        'manage_options', 
        'single_product_edit_section', 
        'single_product_edit_function'
    );
}
add_action('admin_menu', 'custom_dashboard_page');


function enqueue_WP_3DProductAR_style_script() {
    wp_enqueue_style('plugin_style', plugin_dir_url(__FILE__) . '/css/style.css', array(), 1);
    wp_enqueue_script('plugin_script', plugin_dir_url(__FILE__) . '/js/script.js', array(), 1, true);
}
add_action('admin_enqueue_scripts', 'enqueue_WP_3DProductAR_style_script');

function enqueue_model_viewer_plugin() {
    wp_enqueue_script('<script src="https://modelviewer.dev/shared/model-viewer.base.js"></script>');
}
add_action('admin_enqueue_scripts', 'enqueue_model_viewer_plugin');

function enqueue_jquery() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.0.min.js', array(), '3.7.0', true);
}
add_action('admin_enqueue_scripts', 'enqueue_jquery');


function plugin_head(){
    echo '<div class="plugin_head">
    <h1 >WP 3DProductAR Plugin</h1>
    <p>Transform your WooCommerce store by effortlessly incorporating 3D models, revolutionizing how customers engage with and explore your products.</p>';
}

function wp_3dproductar_products_page() {
    plugin_head();
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
    $status = '';
    $product_no = 1;
    $i = 0;
    $product_data .= '
    <div class="emote_plugin_product">
    <table class="emote_product_table">
    <thead class="emote_plugin_product_head">
    <tr>
      <th>S.No</th>
      <th>Product Name</th>
      <th>Product Id</th>
      <th>SKU</th>
      <th>Upload Your 3D Model</th>
      <th>Status</th>
    </tr>
    </thead>';
    foreach ($products as $product) {
        $product_data .= '<tr id="test-id-' . $i . '">';
        $product_data .= '<td>' . $product_no++ . '</td>';
        $product_data .= '<td>' . $product->get_name() . '</td>';
        $product_data .= '<td>' . $product->get_id() . '</td>';
        $product_data .= '<td>' . $product->get_sku() . '</td>';
        $product_data .= '<td class="glb_upload_data_tag">' . '<p id="upload_glb_btn" onclick="selectRow(this)">Upload glb</p></td>';
        $product_data .= '<td>' . $status . '</td>';
        $product_data .= '</tr>';
        echo '<br>';
        $i++;
    }
    $product_data .= '</table> </div>';
    echo $product_data;
}


