<?php

$username = $_POST['Username'];
$password = $_POST['Password'];

$conn = mysqli_connect("localhost","root","",'hotelmini') or die(mysqli_error($conn)) ;
$sql = "SELECT * FROM userdata WHERE username = '$username' AND password = '$password' " ;
$sql1 = "SELECT * FROM empdata WHERE Usernameemp = '$username' AND Passwordemp = '$password' ";

$result = mysqli_query($conn , $sql);
$result1=  mysqli_query($conn , $sql1);

if(!$result || !$result1){

    echo ("ชื่อหรือรหัสไม่ถูกต้อง");
    
}elseif(empty($username) || empty($password)){

    echo ("ชื่อและรหัสห้ามว่าง");

}elseif(mysqli_num_rows($result1) > 0 ){

    $data = mysqli_fetch_array($result1);
    echo ("<div style='text-align: center; font-size: 30px;'>");
    echo ("ล็อกอินสำเร็จ พนักงาน");
    echo ("</div>");

}elseif(mysqli_num_rows($result) > 0){

    $data = mysqli_fetch_array($result1);
    echo ("<div style='text-align: center; font-size: 30px;'>");
    echo ("ล็อกอินสำเร็จ ลูกค้า");
    echo ("</div>");

}else {
    echo ("<div style='text-align: center;'>");
    echo ("รหัสหรือชื่อไม่ถูกต้องอาจมีบ้างอย่างผิดพลาด <br>");
    echo ("<a href = 'Login.html'> กลับไปหน้าล็อกอิน </a>");
    echo ("</div>");
}

?>