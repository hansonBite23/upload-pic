<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Image</title>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <form action="update.php" method="post" enctype="multipart/form-data">
            <?php
            include('../class/Upload.php');
            if (isset($_GET['id'])) {
                $id =  $_GET['id'];
                $edit = new Upload();
                $rows = $edit->retrieve($id);
                $edit_data = $rows->fetch_assoc();

            ?>
                <!-- <input type="hidden" name="id" id="item_id" value="<?php echo $edit_data['id']; ?>" /> -->

                <div class="row mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <div class="col">
                        <input type="text" name="name" id="name" value="<?php echo $edit_data['name']; ?>" />
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="form-label">Status:</label>
                    <div class="col">
                        <select name="status" id="status">
                            <option value="0">Not Active</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image-file" class="form-label">Insert Image:</label>
                    <div class="col">
                        <input type="file" name="image" id="img" />
                    </div>

                    <div class="col">
                        <img src="../<?php echo $edit_data['image']; ?>" id="current_image" class="img-fluid" value="<?php echo $edit_data['image']; ?>">
                    </div>
                </div>

        </form>
        <button class="btn btn-success" id='update_data' name="submit">Submit</button>

    <?php
            } else {

                echo ' Not';
            }
    ?>
    </div>


    <script>
        $(document).ready(function() {

            $('#status').val('<?php echo $edit_data['status']; ?>');

            $('#update_data').click(function(e) {
                e.preventDefault();
                //  console.log('Form submitted');

                let id = <?php echo $_GET['id']; ?>;
                //console.log(id);
                let name = $('#name').val();
                let image = $('#img')[0].files[0]; // Get the file object
                let status = $('#status').val();
                let current_image = $('#current_image').attr('value');
                //console.log(id);

                let formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                formData.append('image', image);
                formData.append('current_image', current_image);
                formData.append('status', status);
                //console.log(image);
                $.ajax({
                    type: "POST",
                    url: "update.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location = '../index.php';
                        // alert(response);
                    }
                });
            });
        });
    </script>


</body>

</html>