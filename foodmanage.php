<?php 
    session_start();
    require_once "config.php";

    if (isset($_GET['delete'])) {
        $delete_ID = $_GET['delete'];
        $deletestmt = $conn->prepare("DELETE FROM food WHERE FoodID = :foodID");
        $deletestmt->bindParam(':foodID', $delete_ID);
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Deleted');</script>";
            $_SESSION['session'] = "Deleted";
            header("refresh:1; url=foodmanage.php");
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="modal fade" id="foodInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Food Insert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="foodupload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="foodname" class="col-form-label">Food Name:</label>
                        <input type="text" required class="form-control" name="foodname">
                    </div>
                    <div class="mb-3">
                        <label for="foodprice" class="col-form-label">Food Price:</label>
                        <input type="text" required class="form-control" name="foodprice">
                    </div>
                    <div class="mb-3">
                        <label for="picture" class="col-form-label">Picture:</label>
                        <input type="file" required class="form-control" id="pictureInput" name="picture">
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
            <h1>Food Insert</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#foodInsert">Add Food</button>
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
                <th scope="col">Price</th>
                <th scope="col">Picture</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt = $conn->query("SELECT * FROM food");
                $stmt->execute();
                $foodData = $stmt->fetchAll();

                if (!$foodData) {
                    echo "<tr><td colspan='5' class='text-center'>Menu is empty</td></tr>";
                } else {
                    foreach ($foodData as $Data) {
            ?>
            <tr>
                <th scope="row"><?= $Data['FoodID']; ?></th>
                <td><?= $Data['FoodName']; ?></td>
                <td><?= $Data['FoodPrice']; ?></td>
                <td width="250px"><img width="100%" src="picture/<?= basename($Data['FoodPicture']); ?>" class="rounded" alt=""></td>
                <td>
                    <a href="foodedit.php?FoodID=<?= $Data['FoodID']; ?>" class="btn btn-warning">Edit</a>
                    <a href="?delete=<?= $Data['FoodID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
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
