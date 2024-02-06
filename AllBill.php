<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบการสั่งซื้อ</title>
    <link rel="stylesheet" href="AllBill.css">
</head>
<body>

    <div class="container">

        <h1>ใบการสั่งซื้อ</h1>

        <!-- แถบค้นหา -->
        <form action="" method="get">
            <label for="search">ค้นหา:</label>
            <input type="text" name="search" id="search">
            <input type="submit" value="ค้นหา">
        </form>

        <!-- ตารางแสดงข้อมูล -->
        <table>
            <tr>
                <th>รหัสการสั่งซื้อ</th>
                <th>ID ลูกค้า</th>
                <th>ID พนักงานดูแล</th>
                <th>ราคาอาหาร</th>
                <th>ราคาห้อง</th>
            </tr>
            <?php

            $conn = mysqli_connect("localhost", "root", "", "hotelmini");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $search = isset($_GET['search']) ? $_GET['search'] : '';

            //เปลี่ยนเป็นอันนี้นะถ้าลูกค้ากดดูบิล แล้วให้เอาชื่อมันมาคนหาบิลเลยให้มันแสดงเฉพาะบิลของมันเท่านั้น
            $sql = "SELECT * FROM cusdata WHERE IDcus LIKE '%$search%' OR Username LIKE '%$search%'";

            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['Username']}</td>
                        <td>{$row['IDcus']}</td>
                        <td>{$row['IDemp']}</td>
                        <td>{$row['Foodprice']}</td>
                        <td>{$row['Roomprice']}</td>
                    </tr>";
            }
            ?>
        </table>

    </div>

</body>
</html>

<?php
mysqli_close($conn);
?>
