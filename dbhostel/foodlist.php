<?php
    session_start();
    require_once "config.php";
    $CustID = $_GET['CustID'];
    echo ("<a style = 'font-size : 20px ;'>$CustID</a>");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1>Menu</h1>
            </div>
        </div>
        <hr>

        <div class="room-container">
            <?php 

                $stmt = $conn->query("SELECT * FROM food");
                $stmt->execute();
                $foodData = $stmt->fetchAll();

                if (empty($foodData)) {
                    echo "<div class='row'><div class='col text-center'>Menu is empty</div></div>";
                } else {
                    $count = 0;

                    foreach ($foodData as $food) {
                        if ($count % 3 == 0) {
                            echo "<div class='row'>";
                        }
            ?>
                        <div class="col-md-4 mb-3">
                            <div class="card" style="width: 400px;" onclick="return confirm('Are you sure?');">
                                <img width="400px" src="picture/<?= basename($food['FoodPicture']); ?>" class="rounded" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $food['FoodName']; ?></h5>
                                    <p><b>Food Price : </b><?= $food['FoodPrice']; ?></p>
                                    <a href="foodbooking.php?FoodID=<?= $food['FoodID']; ?>&CustID=<?= $CustID; ?>" class="btn btn-success" onclick="return confirm('Are you sure?');">Add</a>
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