<?php 
    $CustID = $_GET['CustID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Customer</title>
    <link rel="stylesheet" href="custwindow.css">
</head>
<body>
<div class="welcome-message"><br><br>
    <h1>welcome!</h1><br><br>
</div>

<nav>
    <a href="roomList.php?CustID=<?= $CustID ?>"> Hotel </a>
    <a href="Bill.php"> Bill </a>
</nav>


</body>
</html>
