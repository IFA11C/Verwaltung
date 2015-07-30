<?php
include_once '../php/classes/db_connect.php';

/**
 * Diese Funktion gibt alle Komponenten Arten zurück 
 */
function getComponentTypes() {
    global $mysqli;
    if (!$stmt = $mysqli->prepare("SELECT * FROM komponentenarten")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: cannot prepare statement");
        exit();
    }
    
    $stmt->execute();
    $stmt->bind_result($ka_id, $ka_komponentenart);
    $types = array();
    
    while ($stmt->fetch()) {
        $types[] = array("Id" => $ka_id, "ComponentType" => $ka_komponentenart);
    }
    
    return $types; 
}
