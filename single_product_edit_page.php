<?php



function single_product_edit_function(){
    plugin_head();

   $product_id = $_GET['product-id'];
    $product = wc_get_product($product_id);

    if ($product) {
        $product_name = $product->get_name();
        $product_image = $product->get_image();
        $image_id = $product->get_image_id(); 
        $image_url = wp_get_attachment_image_src($image_id, 'full')[0];  
        $product_sku = $product->get_sku();

       echo '
       <div class="single_product_page">
        <div class="glb_upload_div_section">
        <div class="glb_upload_div">
            <h2 class="product_name">'.$product_name.'</h2>
            <div class="file-input">
            <input type="file" id="file" class="upload_glb_file" accept=".glb">
            <label for="file">Select file</label>
        </div>
        </div>
       <div class="select_template_with_product_img">
        <div>
            <p>How would you prefer the appearance of your 3D model view?</p>
            <p>Default template / your custom made template.</p>
            <div class="select_templte_tag">
                <p id="default_template">Default template</p>
                <p id="custom_template">Custom template</p>
            </div>
           
            </div>
            <img src="' . esc_url($image_url) . '" alt="Product Image">
            </div>

            <p id="back_to_product" onclick="history.back()">Back to Products</p>
            <div id="viewer"></div>
        </div>
       </div>';
    } else {
        echo "Product not found.";
    }
    
}

function upload_glb(){
   
}
upload_glb();
?>


    


