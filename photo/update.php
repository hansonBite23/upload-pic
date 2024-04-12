<?php
include('../class/Upload.php');

if (isset($_POST['id'])) {
    if (empty($_FILES['image']['name'])) { //if the file input is empty, the image still the same
        $name = $_POST['name'];
        $id = $_POST['id'];
        $status = $_POST['status'];
        $image =  $_POST['current_image'];
        $updateName = new Upload();
        $updateName->update($id, $name, $status, $image);
    } else {
        $image = $_FILES['image']['name'];
        $tempFile = $_FILES['image']['tmp_name'];
        $fileSize =  $_FILES['image']['size'];
        $status = $_POST['status'];
        $extension_name = pathinfo($image, PATHINFO_EXTENSION);
        $new_image = 'images/' . $image;

        $name = $_POST['name'];
        $id = $_POST['id'];
        $status = $_POST['status'];
        // echo $new_image;
        $current_image =  $_POST['current_image'];
        // echo $current_image;
        unlink("../" . $current_image);

        $newFile = move_uploaded_file($tempFile, '../images/' . $image);

        $updateAll = new Upload();
        $updateAll->update($id, $name, $status, $new_image);
    }
}
