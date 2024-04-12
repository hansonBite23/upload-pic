<?php
include('../class/Upload.php');
$destroy = new Upload();
$id = $_POST['id'];



$image_link = $destroy->unlink($id);
$img_link = $image_link->fetch_assoc();
if (unlink('../' . $img_link['image'])) {
    $delete = $destroy->destroy($id);

    if ($delete === true) {
        header('Location: ../table.php');
    }
}
