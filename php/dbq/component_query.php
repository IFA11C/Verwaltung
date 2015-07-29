<?php

/**
 * Diese Funktionen kuemmern sich um die Verarbeitung der Komponenten. 
 */

/**
 * Einbindung Globaler Konfigurationen
 */
include_once '/../classes/db_connect.php';

/**
 * Diese Funktion gibt alle Attribute einer Komponente zurück
 */
function getHardwareAttribute($hardwareID) {
    global $mysqli;
    if (!$stmt = $mysqli->prepare("SELECT k.k_id, ka.ka_komponentenart, r.r_nr, k.k_einkaufsdatum, k.k_gewaehrleistungsdauer, k.k_hersteller, k.k_notiz, kha.komponentenattribute_kat_id, kat.kat_bezeichnung, kha.khkat_wert FROM komponenten k inner join komponentenarten ka on k.komponentenarten_ka_id = ka.ka_id left join raeume r on r.r_id = k.raeume_r_id right join komponente_hat_attribute kha on k.k_id = kha.komponenten_k_id left join komponentenattribute kat on kha.komponenten_k_id = kat.kat_id where k.k_id = ' $hardwareID ' ")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: "
                . "cannot prepare statement");
        exit();
    }
    $stmt->execute();       
    $stmt->bind_result(
            $id,       //Hardware ID
            $type,     //hardware type
            $room ,        //Raum ID
            $pDate,        //Kaufdatum
            $warranty,    //Garantie (e.g. 2 for 2 years)
            $manufacturer,  //Hersteller
            $note,        //notes/notizen
            $attributeID,   //HardwareAttribut ID
            $desc,  //AttributsBezeichnung 
            $val);       //Attributswert
            
    
    $hardwareAttribute = array();
    
    while ($stmt->fetch()) {
        $hardwareAttribute[] = array(
            "Id" => $id,
            "Type" => $type,
            "Room" => $room,
            "PDate" => $pDate,
            "Warranty" => $warranty,
            "Manufacturer" => $manufacturer,
            "Note" => $note,
            "AttributID" => $attributeID,
            "Description" => $desc,
            "Value" => $val);  
    }
    return $hardwareAttribute; 
}