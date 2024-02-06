function selectRoom(roomName) {
    document.getElementById('selected-room-info').innerText = `Selected Room: ${roomName}`;
}

function saveRoom() {
    const selectedRoomInfo = document.getElementById('selected-room-info').innerText;

    // Send the selected room information to a server-side script (e.g., using AJAX)
    // For simplicity, let's assume a hypothetical PHP script named save.php

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server if needed
            console.log(xhr.responseText);
        }
    };

    // Send the selected room information to save.php
    xhr.send(`selectedRoomInfo=${encodeURIComponent(selectedRoomInfo)}`);
}
