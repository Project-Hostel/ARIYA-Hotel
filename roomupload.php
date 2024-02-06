<?php 
    session_start();
    require_once "config.php";

    if (isset($_POST['submit'])) {
        $roomName = $_POST['roomname'];
        $maxGuest = $_POST['maxguest'];
        $roomType = $_POST['roomtype'];
        $roomPrice = $_POST['roomprice'];
        $roomStatus = $_POST['roomstatus'];
        $Picture = $_FILES['picture'];

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode(".", $Picture['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;

        $directory = 'picture/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filePath = str_replace("\\", "/", __DIR__ . "/picture/" . $fileNew);

        if (in_array($fileActExt, $allow)) {
            if ($Picture['size'] > 0 && $Picture['error'] == 0) {
                if (move_uploaded_file($Picture['tmp_name'], $filePath)) {
                    $sql = $conn->prepare("INSERT INTO room(RoomName, MaxGuest, RoomType, RoomPrice, RoomStatus, RoomPicture) VALUES (:RoomName, :MaxGuest, :RoomType, :RoomPrice, :RoomStatus, :RoomPicture)");
                    $sql->bindParam(":RoomName", $roomName);
                    $sql->bindParam(":MaxGuest", $maxGuest);
                    $sql->bindParam(":RoomType", $roomType);
                    $sql->bindParam(":RoomPrice", $roomPrice);
                    $sql->bindParam(":RoomStatus", $roomStatus);
                    $sql->bindParam(":RoomPicture", $Picture);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Room Insert Success";
                        header("location: roommanage.php");
                    } else {
                        $_SESSION['error'] = "Room Insert Failed";
                        header("location: roommanage.php");
                    }
                } else {
                    $_SESSION['error'] = "Error uploading file";
                    header("location: roommanage.php");
                }
            } else {
                $_SESSION['error'] = "Invalid file or file size exceeds limit";
                header("location: roommanage.php");
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Allowed types: jpg, jpeg, png";
            header("location: roommanage.php");
        }
    }
?>
