<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['glbFile'])) {
    $tempFilePath = $_FILES['glbFile']['tmp_name'];

    if (!empty($tempFilePath) && is_uploaded_file($tempFilePath)) {
        $fileExtension = pathinfo($_FILES['glbFile']['name'], PATHINFO_EXTENSION);
        $randomFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = './uploads/' . $randomFileName;

        if (move_uploaded_file($tempFilePath, $uploadPath)) {
            $productPath = $uploadPath;
            echo 'File uploaded and saved successfull!';
        } else {
            echo 'Error uploading and saving file.';
        }
    }
}
?>
