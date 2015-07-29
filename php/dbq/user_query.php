<?php
/**
 * Einbindung Globaler Konfigurationen
 */
include_once('/../classes/db_connect.php');

/**
 * Diese Funktion gibt Informationen für den spezifizieren Benutzer zurück 
 */
function getUser($benutzername) {
    global $mysqli;
    
    if(!$stmt = $mysqli->prepare("select distinct * from benutzer where name = '$benutzername'")) {
        header("Location: ./err.php?err=Database error: cannot prepare statement");
        exit();
    }
    
    $stmt->execute();
    $stmt->bind_result($id, $name, $password, $rollen_id);
    $user;
    
    while($stmt->fetch()) {
        $user = array("Id" => $id, "Username" => $name, "Password" => $password, "Rolle" => $rollen_id);
    }
    
    return $user; 
}

/**
 * Diese Funktion gibt Informationen für die spezifizierte Rolle zurück 
 */
function getRoleById($roleId) {
    global $mysqli;
    
    if(!$stmt = $mysqli->prepare("select * from benutzer_rollen where rollen_id = '$roleId'")) {
        header("Location: ./err.php?err=Database error: cannot prepare statement");
        exit();
    }
    
    $stmt->execute();
    $stmt->bind_result($rollen_id, $rollen_beschreibung);
    $role;
    
    while($stmt->fetch()) {
        $role = array("Id" => $rollen_id, "Bezeichnung" => $rollen_beschreibung);
    }
    
    return $role; 
}
