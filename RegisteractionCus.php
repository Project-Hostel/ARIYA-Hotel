<?php

$Username = $_POST["Username"];
$Password = $_POST["Password"];
$Passwordconfirm = $_POST["Passwordconfirm"];
$Email = $_POST["Email"];
$Phone = $_POST["Phone"];

$conn = mysqli_connect("localhost","root","","hotelmini");
$sql = "INSERT INTO customer (CusUsername,CusPassword,CusEmail,CusPhone) VALUE ('$Username','$Password','$Email','$Phone')";

$sql1 = "SELECT * FROM customer WHERE 'CusUsername' " ;

$result = mysqli_query($conn,$sql);

if ($Password =! $Passwordconfirm){
    
    echo "รหัสไม่ตรงกัน" ;

}elseif (empty($Username) || empty($Password) || empty($Passwordconfirm) || empty($Email) || empty($Phone)){

    echo "ห้ามว่าง" ;

}elseif ($sql =! 'CusUsername'){

    echo "ชื่อนี้มีคนใช้แล้ว" ;

}else {

    if(!$result) {

        echo "Something went wrong";

    }else {

        echo "สมัครสำเร็จ" ;
        echo "<br><a href=Login.html > Back to login </a>";

    }  
}

mysqli_close($conn);
?>