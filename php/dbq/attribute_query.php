<?php

/**
 * Diese Funktionen kuemmern sich um die Verarbeitung der Attribute. 
 */

/**
 * Einbindung Globaler Konfigurationen
 */
include_once '/../classes/db_connect.php';

/**
 * Diese Funktion gibt alle Attribute zurück 
 */
function getAttributeNames($mysqli) {
    if (!$stmt = $mysqli->prepare("SELECT * FROM komponentenattribute")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: "
                . "cannot prepare statement");
        exit();
    }
    $stmt->execute();
    $stmt->bind_result($id, $desc);
    $attributes = array();
    while ($stmt->fetch()) {
        $attributes[] = array("Id" => $id, "Description" => $desc);
    }
    return $attributes; 
}