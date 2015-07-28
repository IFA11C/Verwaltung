<?php

/**
 * Diese Funktionen kuemmern sich um die Verarbeitung der Räume. 
 */

/**
 * Einbindung Globaler Konfigurationen
 */
include_once '/../classes/db_connect.php';

/**
 * Diese Funktion gibt alle Räume zurück 
 */
function getRooms($mysqli) {
    if (!$stmt = $mysqli->prepare("SELECT * FROM raeume")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: "
                . "cannot prepare statement");
        exit();
    }
    $stmt->execute();       
    $stmt->bind_result($ID, $NR , $DESC, $NOTE);
    $Rooms = array();
    while ($stmt->fetch()) {
        $Rooms[] = array("Id" => $ID, "Number" => $NR, "Description" => $DESC, "Note" => $NOTE);
    }
    return $Rooms; 
}
?>