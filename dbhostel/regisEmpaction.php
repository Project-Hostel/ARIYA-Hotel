<?php

$Username = $_POST["EmpUsername"];
$Password = $_POST["EmpPassword"];
$Name = $_POST["EmpName"];
$Email = $_POST["EmpEmail"];
$Phone = $_POST["EmpPhone"];

$conn = mysqli_connect("localhost","root","","dbhostel");
$sql = "INSERT INTO employee (EmpUsername,EmpPassword,EmpName,EmpEmail,EmpPhone) VALUES ('$Username','$Password','$Name','$Email','$Phone')";

$result = mysqli_query($conn,$sql);

echo "<br><a href=Login.php > Login </a>";

mysqli_close($conn);
?>