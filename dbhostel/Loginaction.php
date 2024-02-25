<?php

$username = $_POST['Username'];
$password = $_POST['Password'];

$conn = mysqli_connect("localhost", "root", '', 'dbhostel') or die(mysqli_error($conn));
$sql = "SELECT * FROM customer WHERE CustUsername = '$username' AND CustPassword = '$password'";
$sql1 = "SELECT * FROM employee WHERE EmpUsername = '$username' AND EmpPassword = '$password'";

$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Loginaction.css">
</head>

<body>
    <div class="container">
        <div class="message-box">
            <?php
            if (!$result || !$result1) {
                echo "<div class='error-message'>Invalid Password</div>";
            } elseif (empty($username) || empty($password)) {
                echo "<div class='error-message'>Incomplete username or password</div>";
            } elseif (mysqli_num_rows($result1) > 0) {
                $data = mysqli_fetch_array($result1);
            ?>
                <div class='success-message'>Employee Window<br>
                    <a href='empwindow.php?EmpID=<?= $data["EmpID"] ?>'>Home</a>
                </div>
            <?php
            } elseif (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_array($result);
            ?>
                <div class='success-message'>Customer Window<br>
                    <a href='custwindow.php?CustID=<?= $data["CustID"] ?>'>Home</a>
                </div>
            <?php
            } else {
                echo "<div class='error-message'>Something Wrong<br><a href='Login.php'>Back to login</a></div>";
            }
            ?>
        </div>
    </div>
</body>

</html>
