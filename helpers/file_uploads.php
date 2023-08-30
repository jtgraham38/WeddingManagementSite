<?php

function upload_file(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "uploads"; //directory where you want to save uploaded files
        $target_file = $target_dir . '/images/' . basename($_FILES["photo"]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['flash_message'] = "File already exists!";
            $upload_ok = 0;
        }

        // Check file size (adjust as needed)
        if ($_FILES["fileInput"]["size"] > 5000000) {
            $_SESSION['flash_message'] = "File is too large!";
            $upload_ok = 0;
        }

        // Allow only certain file formats
        if ($image_file_type !== "jpg" && $image_file_type !== "png") {
            $_SESSION['flash_message'] = "Only JPG and PNG files are allowed!";
            $upload_ok = 0;
        }

        if ($upload_ok == 0) {
            $_SESSION['flash_message'] = $_SESSION['flash_message'] . "  File was not uploaded.";
            header('Location: /dashboard/photos');
            return false;
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $_SESSION['flash_message'] =  "File has been uploaded and saved as: " . $target_file;
                return true;
            } else {
                $_SESSION['flash_message'] =  "Error uploading file.";
                return false;
            }
        }
    }

}

function delete_uploaded_file($filename){
    $file_to_delete = 'uploads/images/' . $filename; // Replace with the actual path to the file you want to delete
    if (file_exists($file_to_delete)) {
        if (unlink($file_to_delete)) {
            $_SESSION['flash_message'] = "File deleted successfully!";
            return true;
        } else {
            $_SESSION['flash_message'] = "Error deleting the file!";
        }
    } else {
        $_SESSION['flash_message'] = "File not found!";
    }
    return false;
}

?>