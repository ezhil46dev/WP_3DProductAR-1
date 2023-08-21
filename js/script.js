function selectRow(_res){
    let currentRow = _res.parentNode.parentNode;
    let currentId = currentRow.id;
    let _currentRowData = document.getElementById(currentId).innerHTML;
    var tezt = _currentRowData;
    var _splitCurrentRowData = tezt.split("</td><td>");
    console.log(_splitCurrentRowData);
    var productId = _splitCurrentRowData[2];
    window.location.href = `admin.php?page=single_product_edit_section&product-id=${productId}`;
}

jQuery(document).ready(function() {
    jQuery('.upload_glb_file').on('change', function() {
    var fileInput = this;
    var file = fileInput.files[0];

    if (file) {
        var formData = new FormData();
        formData.append('upload_glb_file', file);

        jQuery.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response)    
                }
            });
            }
        });
    });

