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
    if (!$stmt = $mysqli->prepare("SELECT k.k_id, ka.ka_komponentenart, r.r_nr, k.k_einkaufsdatum, k.k_gewaehrleistungsdauer, k.k_hersteller, k.k_notiz FROM komponenten k inner join komponentenarten ka on k.komponentenarten_ka_id = ka.ka_id left join raeume r on r.r_id = k.raeume_r_id ")) {
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
