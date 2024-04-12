<?php
//include '../connection.php';
class Upload
{
    public function index()
    {
        include('connection.php');
        $sql = 'SELECT * FROM `info`';
        $result = mysqli_query($con, $sql);

        return $result;
    }

    public function store($name, $new_image)
    {
        // echo $name;
        // echo $new_image;
        include('connection.php');
        $status = 0;

        $stmt = $con->prepare("INSERT INTO `info` (`name`, `status`, `image`, `created_at`)VALUES (?, ?, ?, NOW() )");
        $stmt->bind_param("sis", $name, $status, $new_image);
        $stmt->execute();

        header('Location: index.php');
    }

    public function retrieve($id)
    {
        include('connection.php');

        $stmt =  $con->prepare("SELECT * FROM `info` WHERE id = $id");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function update($id, $name, $status, $image)
    {
        include('connection.php');

        $stmt = $con->prepare("UPDATE `info` SET `name`=?, `status`=?,`image`=? WHERE `id`= ?");
        $stmt->bind_param('sisi', $name, $status, $image, $id);
        $stmt->execute();
    }


    public function unlink($id)
    {
        include('connection.php');
        $stmt =  $con->prepare("SELECT * FROM `info` WHERE id = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function destroy($id)
    {
        include('connection.php');

        $stmt = $con->prepare("DELETE from `info` WHERE `id`= ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return true;
    }
}
