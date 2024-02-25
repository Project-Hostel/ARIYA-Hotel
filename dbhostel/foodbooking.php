<?php
    session_start();
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $FoodID = $_GET['FoodID'];
        $CustID = $_GET['CustID'];

        $sql = $conn->prepare("SELECT FoodPrice FROM food WHERE FoodID = :FoodID");
        $sql->bindParam(":FoodID", $FoodID);
        $sql->execute();
        $foodPrice = $sql->fetchColumn();

        $sql1 = $conn->prepare("INSERT INTO bookingdetail (CustID) VALUES (:CustID)");
        $sql1->bindParam(":CustID", $CustID);
        $sql1->execute();

        $BDID = $conn->lastInsertId();

        $sql2 = $conn->prepare("INSERT INTO foodbooking (BDID, FoodPrice, FoodID) VALUES (:BDID, :FoodPrice, :FoodID)");
        $sql2->bindParam(":BDID", $BDID);
        $sql2->bindParam(":FoodPrice", $foodPrice);
        $sql2->bindParam(":FoodID", $FoodID);
        $sql2->execute();

        if ($sql1 && $sql2) {
            $_SESSION['success'] = "Food booked successfully";
            header("location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Error inserting data";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1>Food Booking</h1>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <input type="hidden" name="FoodID" value="<?= $FoodID ?>">
                    <button type="submit" class="btn btn-success">Add Food</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
