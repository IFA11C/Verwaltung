<?php 
include './php/classes/db_connect.php';
include './php/dbq/rooms.php';
include './php/dbq/hardware.php';

$rooms = getRooms($mysqli);
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"] . '<br/>';
}
$hardware = getHardware($mysqli);
echo 'Hardware ID | Room ID | Vendor ID | Purchase Date | Warranty | Note | Manufacturer | Type <br/>';
foreach ($hardware as $item) {
    echo $item["Id"] . ' | ' . 
         $item["Room"] . ' | ' . 
         $item["Vendor"] . ' | ' . 
         $item["PDate"] . ' | ' .
         $item["Warranty"] . ' | ' . 
         $item["Note"] . ' | ' . 
         $item["Manufacturer"] . ' | ' . 
         $item["Type"].'<br/>';
}