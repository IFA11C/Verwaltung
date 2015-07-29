<?php 
include './php/classes/db_connect.php';
include './php/dbq/rooms.php';
include './php/dbq/hardware.php';
include './php/dbq/hardwareAttribute.php';

echo '<br/> <b>Räume:</b> <br/>';
$rooms = getRooms($mysqli);
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"] . '<br/>';
}
echo '<br/> <b>Hardware:</b> <br/>';
$hardware = getHardware($mysqli);
echo 'Hardware ID | Hardware Type | Room | Purchase Date | Warranty | Manufacturer | Note <br/>';
foreach ($hardware as $item) {
    echo $item["Id"] . ' | ' . 
         $item["Type"] . ' | ' .   
         $item["Room"] . ' | ' .  
         $item["PDate"] . ' | ' .
         $item["Warranty"] . ' Jahre | ' . 
         $item["Manufacturer"] . ' | ' .
         $item["Note"].'<br/>'; 
}
echo '<br/> <b>Hardware Attribute:</b> <br/>';
$hardwareAttribute = getHardwareAttribute($mysqli, 1);
echo 'Hardware ID | Hardware Type | Room | Purchase Date | Warranty | Manufacturer | Note | Attribut ID | Description | Value <br/>';
foreach ($hardwareAttribute as $attribut) {
    echo $attribut["Id"] . ' | ' . 
         $attribut["Type"] . ' | ' .   
         $attribut["Room"] . ' | ' .  
         $attribut["PDate"] . ' | ' .
         $attribut["Warranty"] . ' Jahre | ' . 
         $attribut["Manufacturer"] . ' | ' .
         $attribut["Note"] . ' | ' .
         $attribut["AttributID"] . ' | ' .
         $attribut["Description"] . ' | ' .
         $attribut["Value"].'<br/>'; 
}