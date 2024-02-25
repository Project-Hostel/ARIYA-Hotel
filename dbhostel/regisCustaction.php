<?php

$Username = $_POST["CustUsername"];
$Password = $_POST["CustPassword"];
$Name = $_POST["CustName"];
$Email = $_POST["CustEmail"];
$Phone = $_POST["CustPhone"];

$conn = mysqli_connect("localhost","root","","dbhostel");
$sql = "INSERT INTO customer (CustUsername,CustPassword,CustName,CustEmail,CustPhone) VALUES ('$Username','$Password','$Name','$Email','$Phone')";

$result = mysqli_query($conn,$sql);

echo "<br><a href=Login.php > Login </a>";

mysqli_close($conn);
?>