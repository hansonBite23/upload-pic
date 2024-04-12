<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<style>
    img {
        height: auto;
        width: 240px;
    }
</style>

<body>

    <div class="container my-">

        <?php
        if (isset($_SESSION['fileSizeExceed'])) {
            echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           ' . $_SESSION['fileSizeExceed'] . '
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            unset($_SESSION['fileSizeExceed']);
        } elseif (isset($_SESSION['invalid_format'])) {

            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $_SESSION['invalid_format'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
            unset($_SESSION['invalid_format']);
        }
        ?>



        <h2 class="text-center">Upload Image</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="name" class="form-label">Name:</label>
                <div class="col">
                    <input type="text" name="name" id="name_input" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="image-file" class="form-label">Insert Image:</label>
                <div class="col">
                    <input type="file" name="image" id="img" />
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="submit">Submit</button>

        </form>
        <div class="d-flex justify-content-center">
            <div class="spinner-border loading" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


        <div class="table-data"></div>

    </div>
   

    <script>
        $(document).ready(function() {
            let spin = $('.loading').hide();



            $.ajax({
                type: "get",
                url: "table.php",
                data: "",
                beforeSend: function() {
                    spin.show();
                },
                success: function(response) {
                    $('.table-data').html(response);
                    spin.hide();
                }
            });


        });
    </script>

</body>


</html>