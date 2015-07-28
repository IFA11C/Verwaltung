<?php 
include './php/classes/db_connect.php';
include './php/dbq/rooms.php';

$rooms = getRooms($mysqli);
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"];
}