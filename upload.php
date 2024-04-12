<?php
session_start();
include 'class/Upload.php';
if (isset($_POST['submit'])) {
    $filename = $_FILES['image']['name'];
    $tempFile = $_FILES['image']['tmp_name'];
    $fileSize =  $_FILES['image']['size'];

    $extension_name = pathinfo($filename, PATHINFO_EXTENSION);
    $new_image = 'images/' . $filename;

    if (in_array($extension_name, ['jpg', 'png', 'jpeg', 'webp'])) {
        if ($fileSize > 5000) {
            // $newFile = $tempFile . '.' . $extension_name;

            $name =  $_POST['name'];
            $newFile = move_uploaded_file($tempFile, $new_image);

            $upload = new Upload();
            $upload->store($name, $new_image);
        } else {
            session_start();
            $_SESSION['fileSizeExceed'] = 'Image must be 5 mb below';
            header('Location: index.php');
        }
    } else {
        session_start();
        $_SESSION['invalid_format'] = 'Invalid format.It should be jpg, jpeg, png or webp';
        header('Location: index.php');
    }
}
