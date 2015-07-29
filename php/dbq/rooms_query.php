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
    $stmt->bind_result($id, $nr, $description, $note);
    $rooms = array();
    while ($stmt->fetch()) {
        $rooms[] = array("Id" => $id, "Number" => $nr, "Description" => $description, "Note" => $note);
    }
    return $rooms; 
}