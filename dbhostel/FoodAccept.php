<?php 
    session_start();
    require_once "config.php";

    if (isset($_GET['delete'])) {
        $delete_ID = $_GET['delete'];
        $deletestmt = $conn->prepare("DELETE FROM foodbooking WHERE FoodBookID = :foodbookID");
        $deletestmt->bindParam(':foodbookID', $delete_ID);
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Deleted');</script>";
            $_SESSION['session'] = "Deleted";
            header("refresh:1; url=FoodAccept.php");
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

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Food Accept</h1>
        </div>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">BDID</th>
                <th scope="col">Food ID</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt = $conn->query("SELECT * FROM foodbooking");
                $stmt->execute();
                $foodData = $stmt->fetchAll();

                if (!$foodData) {
                    echo "<tr><td colspan='5' class='text-center'>Empty</td></tr>";
                } else {
                    foreach ($foodData as $Data) {
            ?>
            <tr>
                <th scope="row"><?= $Data['FoodBookID']; ?></th>
                <td><?= $Data['BDID']; ?></td>
                <td><?= $Data['FoodID']; ?></td>
                <td>
                    <a href="FAaction.php?=<?= $Data['FoodBookID']; ?>" class="btn btn-success" onclick="return confirm('Are you sure?');">Accept</a>
                    <a href="?delete=<?= $Data['FoodBookID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Denied</a>
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
