<?php 
    session_start();
    require_once "config.php";

    if (isset($_GET['delete'])) {
        $delete_ID = $_GET['delete'];
        $deletestmt = $conn->prepare("DELETE FROM room WHERE RoomID = :roomID");
        $deletestmt->bindParam(':roomID', $delete_ID);
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Deleted');</script>";
            $_SESSION['session'] = "Deleted";
            header("refresh:1; url=roommanage.php");
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="modal fade" id="roomInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Room Insert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="roomupload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="roomname" class="col-form-label">Room Name:</label>
                        <input type="text" required class="form-control" name="roomname">
                    </div>
                    <div class="mb-3">
                        <label for="maxguest" class="col-form-label">Max Guest:</label>
                        <input type="text" required class="form-control" name="maxguest">
                    </div>
                    <div class="mb-3">
                        <label for="roomtype" class="col-form-label">Room Type:</label>
                        <input type="text" required class="form-control" name="roomtype">
                    </div>
                    <div class="mb-3">
                        <label for="roomprice" class="col-form-label">Room Price:</label>
                        <input type="text" required class="form-control" name="roomprice">
                    </div>
                    <div class="mb-3">
                        <label for="roomstatus" class="col-form-label">Room Status:</label>
                        <input type="text" required class="form-control" name="roomstatus">
                    </div>
                    <div class="mb-3">
                        <label for="roompicture" class="col-form-label">Picture:</label>
                        <input type="file" required class="form-control" id="pictureInput" name="roompicture">
                        <img width="100%" id="previewPicture" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Room Manage</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roomInsert">Add Room</button>
        </div>
    </div>
    <hr>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Capacity</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Picture</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt = $conn->query("SELECT * FROM room");
                $stmt->execute();
                $foodData = $stmt->fetchAll();

                if (!$foodData) {
                    echo "<tr><td colspan='10' class='text-center'>Room is empty</td></tr>";
                } else {
                    foreach ($foodData as $Data) {
            ?>
            <tr>
                <th scope="row"><?= $Data['RoomID']; ?></th>
                <td><?= $Data['RoomName']; ?></td>
                <td><?= $Data['MaxGuest']; ?></td>
                <td><?= $Data['RoomType']; ?></td>
                <td><?= $Data['RoomPrice']; ?></td>
                <td><?= $Data['RoomStatus']; ?></td>
                <td width="250px"><img width="100%" src="picture/<?= basename($Data['RoomPicture']); ?>" class="rounded" alt=""></td>
                <td>
                    <a href="?delete=<?= $Data['RoomID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php }
                } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    let pictureInput = document.getElementById('pictureInput');
    let previewPicture = document.getElementById('previewPicture');

    pictureInput.onchange = evt => {
        const [file] = pictureInput.files;
        if (file) {
            previewPicture.src = URL.createObjectURL(file);
        }
    }
</script>
</body>
</html>
