<?php

$Username = $_POST["Username"];
$Password = $_POST["Password"];
$Passwordconfirm = $_POST["Passwordconfirm"];

$conn = mysqli_connect("localhost","root","","hotelmini");
$sql = "INSERT INTO userdata (username,password) VALUE ('$Username','$Password')";

$sql1 = "SELECT * FROM userdata WHERE 'username' " ;

$result = mysqli_query($conn,$sql);

if ($Password =! $Passwordconfirm){
    
    echo "รหัสไม่ตรงกัน" ;

}elseif ($sql =! 'username'){

    echo "ชื่อนี้มีคนใช้แล้ว" ;

}else {

    if(!$result) {

        echo "Something went wrong";

    }else {

        echo "สมัครสำเร็จ" ;
        echo "<br><a href=Login.php > Back to login </a>";

    }  
}

mysqli_close($conn);
?>