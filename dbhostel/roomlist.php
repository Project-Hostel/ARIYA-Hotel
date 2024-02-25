<?php
    session_start();
    require_once "config.php";
    $CustID = $_GET['CustID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1>Room List</h1>
            </div>
        </div>
        <hr>

        <div class="room-container">
            <?php 
                $stmt = $conn->query("SELECT * FROM room");
                $stmt->execute();
                $roomData = $stmt->fetchAll();

                if (empty($roomData)) {
                    echo "<div class='row'><div class='col text-center'>Room is empty</div></div>";
                } else {
                    $count = 0;

                    foreach ($roomData as $room) {
                        if ($count % 3 == 0) {
                            echo "<div class='row'>";
                        }
            ?>
                        <div class="col-md-4 mb-3">
                            <div class="card" style="width: 400px;" onclick="return confirm('Are you sure?');">
                                <img width="400px" src="picture/<?= basename($room['RoomPicture']); ?>" class="rounded" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $room['RoomName']; ?></h5>
                                    <p><b>Max Guest : </b><?= $room['MaxGuest']; ?></p>
                                    <p><b>Type : </b><?= $room['RoomType']; ?></p>
                                    <p><b>Price : </b><?= $room['RoomPrice']; ?></p>
                                    <p><b>Status : </b><?= $room['RoomStatus']; ?></p>
                                    <a href="roombooking.php?RoomID=<?= $room['RoomID']; ?>&CustID=<?= $CustID ?>" class="btn btn-success" onclick="return confirm('Are you sure?');">Book</a>
                                </div>
                            </div>
                        </div>
            <?php
                        $count++;
                        if ($count % 3 == 0) {
                            echo "</div>";
                        }
                    }
                    if ($count % 3 != 0) {
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>

</body>
</html>