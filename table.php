<?php
include_once 'class/Upload.php';

//include 'connection.php';
?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <?php
    $getData = new Upload();
    $result = $getData->index();
    foreach ($result as $res) {

    ?>

        <tbody>
            <tr>
                <th scope="row"><?php echo $res['name']; ?></th>
                <td><img src="<?php echo $res['image']; ?>" class="img-fluid"></td>
                <td>
                    <?php
                    echo $res['status'] == 0 ? 'Not Active' : 'Active';
                    ?>
                </td>
                <td>
                    <a href="photo/edit.php?id=<?php echo $res['id']; ?>" class="btn btn-secondary">Edit</a>

                    <button type="button" class="btn btn-danger delete" id="<?php echo $res['name']; ?>" id_number="<?php echo $res['id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete
                    </button>
                </td>
            </tr>
        <?php }
        ?>
        </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-danger confirm-delete" name="" data-delete-id>Yes</button>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var deleteId; // Declare a variable to store the id

        $('.delete').click(function() {
            var name = $(this).attr('id');
            deleteId = $(this).attr('id_number');
            $('.modal-body').html('Delete ' + name + '?');
        });

        $('.confirm-delete').click(function() {
            $.ajax({
                type: "POST",
                url: "photo/destroy.php",
                data: {
                    id: deleteId
                },
                success: function(response) {
                    //alert(response);
                    location.reload('../index.php');
                }
            });
        });
    });
</script>