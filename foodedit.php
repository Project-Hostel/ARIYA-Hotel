<?php 
    session_start();
    require_once "config.php";

    if (isset($_POST['update'])) {
        $foodID = $_POST['foodid'];
        $foodName = $_POST['foodname'];
        $foodPrice = $_POST['foodprice'];
        $foodPicture = $_FILES['foodpicture'];

        $foodPicture2 = $_FILES['foodpicture2'];
        $upload = $_FILES['foodpicture']['name'];

        if ($upload != '') {
            $allow = array('jpg', 'jpeg', 'png');
            $extension = explode(".", $Picture['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;
            $filePath = "picture/".$fileNew;
            
            if (in_array($fileActExt, $allow)) {
                if ($Picture['size'] > 0 && $Picture['error'] == 0) {
                    move_uploaded_file($Picture['tmp_name'], $filePath);
                }
            }
        } else {
            $fileNew = $foodPicture2;
        }

        $sql = $conn->prepare("UPDATE food SET FoodName = :foodname, FoodPrice = :foodprice FoodPicture = :foodpicture WHERE FoodID = :foodid");
        $sql->bindParam(":foodid", $foodID);
        $sql->bindParam(":foodname", $foodName);
        $sql->bindParam(":foodprice", $foodPrice);
        $sql->bindParam(":foodpicture", $foodPicture);
        $sql->execute();
        if ($sql) {
            $_SESSION['success'] = "Update success";
        } else {
            $_SESSION['error'] = "Update failed";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Insert</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>

  </head>
  <body>

    <div class="container mt-5">
        <h1>Food Edit</h1>
        <hr>
        <form action="foodedit.php" method="post" enctype="multipart/form-data">
            <?php 
                if (isset($_GET['FoodID'])) {
                    $FoodID = $_GET['FoodID'];
                    $stmt = $conn->query("SELECT * FROM food WHERE FoodID = $FoodID");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
            <div class="mb-3">
                <input type="text" readonly value="<?= $data['FoodID']; ?>" required class="form-control" name="foodid">
                <label for="foodname" class="col-form-label">Food Name:</label>
                <input type="text" value="<?= $data['FoodName']; ?>" required class="form-control" name="foodname">
                <input type="hidden" value="<?= $data['FoodPicture']; ?>" required class="form-control" name="foodpicture2">
            </div>
            <div class="mb-3">
                <label for="foodprice" class="col-form-label">Food Price:</label>
                <input type="text" value="<?= $data['FoodPrice']; ?>" required class="form-control" name="foodprice">
            </div>
            <div class="mb-3">
                <label for="picture" class="col-form-label">Picture:</label>
                <input type="file" class="form-control" id="pictureInput" name="foodpicture">
                <img width="100%" src="picture/<?= $data['FoodPicture']; ?>" id="previewPicture" alt="">
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="foodmanage.php">Go Back</a>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        let pictureInput = document.getElementById('pictureInput');
        let previewPicture = document.getElementById('previewPicture');

        pictureInput.onchange = evt => {
            const [file] = pictureInput.files;
            if (file) {
                previewPicture.src = URL.createObjectURL(file);
            }
        }
    </script>
  </body>
</html>