<?php
    session_start();
    require_once "config.php";
    $CustID = $_GET['CustID'];
    echo ("<a style = 'font-size : 20px ;'>$CustID</a>");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CustID = $_GET['CustID'];
        echo "this is id = ".$CustID;
        $RoomID = $_GET['RoomID'];
        $CheckinDate = $_POST['CheckinDate'];
        $CheckoutDate = $_POST['CheckoutDate'];
        $GuestNumber = $_POST['GuestNumber'];

        $sql = $conn->prepare("INSERT INTO bookingdetail (CustID) VALUES (:CustID)");
        $sql->bindParam(":CustID", $CustID);
        $sql->execute();

        $sql2 = $conn->prepare("SELECT * FROM bookingdetail,customer WHERE bookingdetail.CustID = customer.CustID AND CustID = '$CustID' ");
        $sql2->bindParam(":CustID", $CustID);
        $sql2->execute();
        echo "$sql2";

        //$BDID = $sql2->fetchArray();
        //echo "$BDID['BDID']";

        $sql1 = $conn->prepare("INSERT INTO roombooking (RoomID, BDID, CheckinDate, CheckoutDate, GuestNumber) VALUES (:RoomID, :BDID, :CheckinDate, :CheckoutDate, :GuestNumber)");
        $sql1->bindParam(":RoomID", $RoomID);
        $sql1->bindParam(":BDID", $BDID);
        $sql1->bindParam(":CheckinDate", $CheckinDate);
        $sql1->bindParam(":CheckoutDate", $CheckoutDate);
        $sql1->bindParam(":GuestNumber", $GuestNumber);
        $sql1->execute();

        if ($sql && $sql1) {
            $_SESSION['success'] = "Room booked successfully";
            header("location: foodlist.php");
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
    <title>Room Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1>Room Booking</h1>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <form method="get" action="foodlist.php">
                    <div class="mb-3">
                        <label for="CheckinDate" class="form-label">Checkin Date:</label>
                        <input type="date" class="form-control" id="CheckinDate" name="CheckinDate" required>
                        <label for="CheckoutDate" class="form-label">Checkout Date:</label>
                        <input type="date" class="form-control" id="CheckoutDate" name="CheckoutDate" required>
                        <label for="GuestNumber" class="form-label">Guest Number:</label>
                        <input type="text" class="form-control" id="Guest Number" name="GuestNumber" required>
                    </div>
                    <input type="hidden" name="CustID" value="<?= $CustID ?>">
                    <input type="hidden" name="BDID" value="<?= $BDID['BDID'] ?>">
                    <button type="submit" class="btn btn-success" href = "bookdetail.php?BDID ={$sql2['BDID']}">Book Room</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
