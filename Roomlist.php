<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Rooms</title>
    <link rel="stylesheet" href="Roomlist.css">
</head>

<body>
    <div class="room-container">
        <div class="room" onclick="selectRoom('Room 101')">
            <img src="Hotel.jpg" alt="Room 101">
            <h2>Room 101</h2>
            <p>Queen Bed, Private Bathroom, Wi-Fi</p>
        </div>

        <div class="room" onclick="selectRoom('Room 102')">
            <img src="room2.jpg" alt="Room 102">
            <h2>Room 102</h2>
            <p>King Bed, Ocean View, Balcony</p>
        </div>
    </div>

    <div id="selected-room">
        <h2>Selected Room</h2>
        <p id="selected-room-info">No room selected</p>
        <button onclick="saveRoom()">Save</button>
    </div>

    <script src="script.js"></script>
</body>

</html>
   