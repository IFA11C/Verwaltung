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
            $ID,       //Hardware ID
            $ROOM ,        //Room ID
            $VENDOR,       //Vendor ID
            $PDATE,        //Purchase Date
            $WARRANTY,    //Warranty (e.g. 2 for 2 years)
            $NOTE,        //notes/notizen
            $MANUFACTURER,  //manufacturer
            $TYPE);     //hardware type
    
    $hardware = array();
    
    while ($stmt->fetch()) {
        $hardware[] = array(
            "Id" => $ID, 
            "Room" => $ROOM, 
            "Vendor" => $VENDOR, 
            "PDate" => $PDATE, 
            "Warranty" => $WARRANTY, 
            "Note" => $NOTE, 
            "Manufacturer" => $MANUFACTURER, 
            "Type" => $TYPE);
    }
    return $hardware; 
}