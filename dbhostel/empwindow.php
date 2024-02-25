<!DOCTYPE html>
<html lang="en">

<?php
    $empID = $_GET['EmpID'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="empwindow.css">
</head>

<body>
    <div class="header">
        <div class="welcome-message"><br>
            <h1>Manage</h1><br>
        </div>
        <nav>
            <a href="RoomManage.php"> Room Manage </a>
            <a href="FoodManage.php"> Food Manage </a>
            <a href="FoodAccept.php?EmpID=<?= $empID ?>"> Food Accept </a>
            <a href="RoomAccept.php?EmpID=<?= $empID ?>"> Room Accept </a>
            <a href="AllBill.php"> Bill </a>
        </nav>
    </div>
</body>

</html>
