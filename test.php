<?php 
include './php/classes/db_connect.php';
include './php/dbq/rooms.php';
include './php/dbq/hardware.php';

$rooms = getRooms($mysqli);
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"] . '<br/>';
}
$hardware = getHardware($mysqli);
echo 'Hardware ID | Room | Purchase Date | Warranty | Manufacturer | Note |  Type <br/>';
foreach ($hardware as $item) {
    echo $item["Id"] . ' | ' . 
         $item["Type"] . ' | ' .   
         $item["Room"] . ' | ' .  
         $item["PDate"] . ' | ' .
         $item["Warranty"] . ' | ' . 
         $item["Manufacturer"] . ' | ' .
         $item["Note"].'<br/>'; 
}