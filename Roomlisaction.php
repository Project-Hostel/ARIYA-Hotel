<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $selectedRoomInfo = $_POST['selectedRoomInfo'];

    $conn = new mysqli("localhost", "username", "password", "hotlemini");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO room (numberroom) VALUES (?)");
    $stmt->bind_param("s", $selectedRoomInfo);

    if ($stmt->execute()) {
        echo "Room information saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
