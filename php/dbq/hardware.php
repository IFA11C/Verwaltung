<?php
/**
 * Diese Funktionen kuemmern sich um die Verarbeitung der Hardware. 
 */

/**
 * Einbindung Globaler Konfigurationen
 */
include_once '/../classes/db_connect.php';

/**
 * Diese Funktion gibt alle Hardware zurück 
 */
function getHardware($mysqli) {
    if (!$stmt = $mysqli->prepare("SELECT * FROM komponenten")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: "
                . "cannot prepare statement");
        exit();
    }
    $stmt->execute();       
    $stmt->bind_result(
            $id,       //Hardware ID
            $room ,        //Room ID
            $vendor,       //Vendor ID
            $pDate,        //Purchase Date
            $warranty,    //Warranty (e.g. 2 for 2 years)
            $note,        //notes/notizen
            $manufacturer,  //manufacturer
            $type);     //hardware type
    
    $hardware = array();
    
    while ($stmt->fetch()) {
        $hardware[] = array(
            "Id" => $id, 
            "Room" => $room, 
            "Vendor" => $vendor, 
            "PDate" => $pDate, 
            "Warranty" => $warranty, 
            "Note" => $note, 
            "Manufacturer" => $manufacturer, 
            "Type" => $type);
    }
    return $hardware; 
}