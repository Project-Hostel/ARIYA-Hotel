<?php

$username = $_POST['Username'];
$password = $_POST['Password'];

$conn = mysqli_connect("localhost", "root", '', 'hotelmini') or die(mysqli_error($conn));
$sql = "SELECT * FROM userdata WHERE username = '$username' AND password = '$password'";
$sql1 = "SELECT * FROM empdata WHERE Usernameemp = '$username' AND Passwordemp = '$password'";

$result = mysqli_query($conn, $sql);
$result1 =  mysqli_query($conn, $sql1);

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
        <?php
        echo '<div class="message-box">';
        if (!$result || !$result1) {
            echo "<div class='error-message'>ชื่อหรือรหัสไม่ถูกต้อง</div>";
        } elseif (empty($username) || empty($password)) {
            echo "<div class='error-message'>ชื่อและรหัสห้ามว่าง</div>";
        } elseif (mysqli_num_rows($result1) > 0) {
            echo "<div class='success-message'>ล็อกอินสำเร็จ พนักงาน<br><a href='HomeEmp.php'>Home</a></div>";
        } elseif (mysqli_num_rows($result) > 0) {
            echo "<div class='success-message'>ล็อกอินสำเร็จ ลูกค้า<br><a href='HomeCus.php'>Home</a></div>";
        } else {
            echo "<div class='error-message'>รหัสหรือชื่อไม่ถูกต้องอาจมีบ้างอย่างผิดพลาด<br><a href='Login.php'>กลับไปหน้าล็อกอิน</a></div>";
        }
        echo '</div>';
        ?>
    </div>
</body>

</html>
