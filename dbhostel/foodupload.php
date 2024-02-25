<?php 
    session_start();
    require_once "config.php";

    if (isset($_POST['submit'])) {
        $foodName = $_POST['foodname'];
        $foodPrice = $_POST['foodprice'];
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
                    $sql = $conn->prepare("INSERT INTO food(FoodName, FoodPrice, FoodPicture) VALUES (:FoodName, :FoodPrice, :FoodPicture)");
                    $sql->bindParam(":FoodName", $foodName);
                    $sql->bindParam(":FoodPrice", $foodPrice);
                    $sql->bindParam(":FoodPicture", $filePath);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Food Insert Success";
                        header("location: foodmanage.php");
                    } else {
                        $_SESSION['error'] = "Food Insert Failed";
                        header("location: foodmanage.php");
                    }
                } else {
                    $_SESSION['error'] = "Error uploading file";
                    header("location: foodmanage.php");
                }
            } else {
                $_SESSION['error'] = "Invalid file or file size exceeds limit";
                header("location: foodmanage.php");
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Allowed types: jpg, jpeg, png";
            header("location: foodmanage.php");
        }
    }
?>
