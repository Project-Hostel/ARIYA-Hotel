<?php 
    session_start();
    require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="stylesheet" href="AllBill.css">
</head>
<body>

    <div class="container">

        <h1>Bill List</h1>

        <form action="" method="get">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search">
            <input type="submit" value="search">
        </form>

        <table>
            <tr>
                <th>#</th>
                <th>Employee ID</th>
                <th>Customer ID</th>
                <th>TotalPrice</th>
            </tr>
            <?php

            $search = isset($_GET['search']) ? $_GET['search'] : '';

            $sql = $conn->prepare("SELECT * FROM bookingdetail WHERE BDID LIKE '%$search%' OR CustID LIKE '%$search%'");
            $sql->execute();
            $allbill = $sql->fetchAll();
            
            if (!$allbill) {
                echo "<tr><td colspan='10' class='text-center'>Empty</td></tr>";
            } else {
                foreach ($allbill as $Data) {
                echo "<tr>
                        <td>{$Data['BDID']}</td>
                        <td>{$Data['EmpID']}</td>
                        <td>{$Data['CustID']}</td>
                        <td>{$Data['TotalPrice']}</td>
                    </tr>";
                }
            }
            ?>
        </table>

    </div>

</body>
</html>
