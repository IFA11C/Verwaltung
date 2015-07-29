<?php
/**
 * Diese Funktionen kuemmern sich um die Verarbeitung der HardwareAttribute. 
 */

/**
 * Einbindung Globaler Konfigurationen
 */
include_once '/../classes/db_connect.php';

/**
 * Diese Funktion gibt alle HardwareAttribute zurück 
 */
function getHardwareAttribute($mysqli, $HardwareID) {
    if (!$stmt = $mysqli->prepare("SELECT k.k_id, ka.ka_komponentenart, r.r_nr, k.k_einkaufsdatum, k.k_gewaehrleistungsdauer, k.k_hersteller, k.k_notiz, kha.komponentenattribute_kat_id, kat.kat_bezeichnung, kha.khkat_wert FROM komponenten k inner join komponentenarten ka on k.komponentenarten_ka_id = ka.ka_id left join raeume r on r.r_id = k.raeume_r_id right join komponente_hat_attribute kha on k.k_id = kha.komponenten_k_id left join komponentenattribute kat on kha.komponenten_k_id = kat.kat_id where k.k_id = '$HardwareID' ")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: "
                . "cannot prepare statement");
        exit();
    }
    $stmt->execute();       
    $stmt->bind_result(
            $ID,       //Hardware ID
            $TYPE,     //hardware type
            $ROOM ,        //Raum ID
            $PDATE,        //Kaufdatum
            $WARRANTY,    //Garantie (e.g. 2 for 2 years)
            $MANUFACTURER,  //Hersteller
            $NOTE,        //notes/notizen
            $ATTRIBUTID,   //HardwareAttribut ID
            $DESCRIPTION,  //AttributsBezeichnung 
            $VALUE);       //Attributswert
            
    
    $hardwareAttribute = array();
    
    while ($stmt->fetch()) {
        $hardwareAttribute[] = array(
            "Id" => $ID,
            "Type" => $TYPE,
            "Room" => $ROOM,
            "PDate" => $PDATE,
            "Warranty" => $WARRANTY,
            "Manufacturer" => $MANUFACTURER,
            "Note" => $NOTE,
            "AttributID" => $ATTRIBUTID,
            "Description" => $DESCRIPTION,
            "Value" => $VALUE);  
    }
    return $hardwareAttribute; 
}