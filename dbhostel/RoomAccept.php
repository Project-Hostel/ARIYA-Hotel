<?php 
    session_start();
    require_once "config.php";

    if (isset($_GET['delete'])) {
        $delete_ID = $_GET['delete'];
        $deletestmt = $conn->prepare("DELETE FROM roombooking WHERE RoomBookID = :roombookID");
        $deletestmt->bindParam(':roombookID', $delete_ID);
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Deleted');</script>";
            $_SESSION['session'] = "Deleted";
            header("refresh:1; url=RoomAccept.php");
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Accept</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Room Accept</h1>
        </div>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Booking Detail ID</th>
                <th scope="col">Checkin</th>
                <th scope="col">Checkout</th>
                <th scope="col">GuestNumber</th>
                <th scope="col">RoomID</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt = $conn->query("SELECT * FROM roombooking");
                $stmt->execute();
                $roomData = $stmt->fetchAll();

                if (!$roomData) {
                    echo "<tr><td colspan='5' class='text-center'>Empty</td></tr>";
                } else {
                    foreach ($roomData as $Data) {
            ?>
            <tr>
                <th scope="row"><?= $Data['RoomBookID']; ?></th>
                <td><?= $Data['BDID']; ?></td>
                <td><?= $Data['CheckinDate']; ?></td>
                <td><?= $Data['CheckoutDate']; ?></td>
                <td><?= $Data['GuestNumber']; ?></td>
                <td><?= $Data['RoomID']; ?></td>
                <td>
                    <a href="RAaction.php?=<?= $Data['RoomBookID']; ?>" class="btn btn-success" onclick="return confirm('Are you sure?');">Accept</a>
                    <a href="?delete=<?= $Data['RoomBookID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Denied</a>
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
