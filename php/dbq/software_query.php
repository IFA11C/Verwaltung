<?php
/*
 * Dieser PHP-Code enthält die Queries um Software
 * hinzuzufügen, bearbeiten und löschen.
 * 
 * Software sind Komponenten die einen eintrag in
 * der software_in_raum Tabelle haben. Deswegen
 * werden die Komponenten Queries verwendet um die
 * Komponenten in der Datenbank zu ändern.
 */

//Inkludieren der Datenbank verbindung und des mysqli Objekts.
include_once('../php/classes/db_connect.php');
//Inkludierung der Komponenten Queries
//e.g. insertComponent, updateComponent, removeComponent
include_once('all_components_query.php');

/*
 * Wenn der Hinzufügen Knopf auf der Seite gedrückt wurde werden die Formular Felder
 * ausgelesen und eine neue Software mit den entsprechenden Werten wird in der
 * Datenbank angelegt.
 */
if (isset($_POST['btnInsertSoftware'])) {
    if (isset($_POST['komponentenart_ka_id'], $_POST['raeume_r_id'], $_POST['k_einkaufsdatum'], $_POST['k_gewaehrleistungsdauer'], $_POST['k_hersteller'], $_POST['k_notiz'])) {
        $komponentenart_ka_id = filter_input(INPUT_POST, 'komponentenart_ka_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $raeume_r_id = filter_input(INPUT_POST, 'raeume_r_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_einkaufsdatum = filter_input(INPUT_POST, 'k_einkaufsdatum', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_gewaehrleistungsdauer = filter_input(INPUT_POST, 'k_gewaehrleistungsdauer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_hersteller = filter_input(INPUT_POST, 'k_hersteller', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_notiz = filter_input(INPUT_POST, 'k_notiz', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (empty($error_msg)) {
            if ($k_id = insertComponent(
                    $komponentenart_ka_id,
                    $raeume_r_id,
                    $k_einkaufsdatum,
                    $k_gewaehrleistungsdauer,
                    $k_hersteller,
                    1, //Es gibt nur einen Lieferanten der nicht gewählt werden soll.
                    $k_notiz)) {
                
                insertSoftware($k_id, $raeume_r_id);
                header("Location: ./software.php");
            }
            else {
                 header("Location: ./err.php?err=Fehler beim erstellen der Software.");
            }
            exit();
        }
    }
}

/*
 * Wenn der Änderungen speichern Knopf auf der Seite gedrückt wurde werden die
 * Formular Felder ausgelesen und die Werte der entsprechenden Software werden
 * aktualisert.
 */
if (isset($_POST['btnUpdateSoftware'])) {
    if (isset($_POST['k_id'], $_POST['komponentenart_ka_id'], $_POST['raeume_r_id'], $_POST['k_einkaufsdatum'], $_POST['k_gewaehrleistungsdauer'], $_POST['k_hersteller'], $_POST['k_notiz'])) {
        $k_id = filter_input(INPUT_POST, 'k_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $komponentenart_ka_id = filter_input(INPUT_POST, 'komponentenart_ka_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $raeume_r_id = filter_input(INPUT_POST, 'raeume_r_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_einkaufsdatum = filter_input(INPUT_POST, 'k_einkaufsdatum', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_gewaehrleistungsdauer = filter_input(INPUT_POST, 'k_gewaehrleistungsdauer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_hersteller = filter_input(INPUT_POST, 'k_hersteller', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_notiz = filter_input(INPUT_POST, 'k_notiz', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (empty($error_msg)) {
            if(updateComponent(
                $k_id,
                $komponentenart_ka_id,
                $raeume_r_id,
                $k_einkaufsdatum,
                $k_gewaehrleistungsdauer,
                $k_hersteller,
                1,
                $k_notiz)) {
                
                if(updateSoftware($k_id, $raeume_r_id)) {
                    header('Location: ./software.php');
                }
            } else {
                header('Location: ./err.php?err=Fehler beim aktualisieren der Software');
            }
            exit();
        }
    }
}

/*
 * Wenn der Löschen Knopf auf der Seite gedrückt wurde
 * wird die entsprechende Software aus der Datenbank entfernt.
 */
if (isset($_POST['btnRemoveSoftware'])) {
    if (isset($_POST['k_id'])) {
        $id = filter_input(INPUT_POST, 'k_id', FILTER_SANITIZE_NUMBER_INT);
        if (empty($error_msg)) {
            if (removeSoftware($id)) {
                if(removeComponent($id)) {
                    header('Location: ./software.php');
                }
            } else {
                header('Location: ./err.php?err=Fehler beim löschen der Software');
            }

            exit();
        }
    }
}

/**
 * Diese Funktion gibt alle Softwares zurück 
 */
function getAllSoftware() {
    global $mysqli;
    if (!$stmt = $mysqli->prepare(
            "SELECT k.k_id, ka.ka_komponentenart, r.r_nr, k.k_einkaufsdatum, k.k_gewaehrleistungsdauer, k.k_hersteller, k.k_notiz
                FROM komponenten k 
                inner join komponentenarten ka on k.komponentenarten_ka_id = ka.ka_id 
                left join raeume r on r.r_id = k.raeume_r_id
                inner join software_in_raum sir on sir.sir_k_id = k.k_id")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: "
                . "cannot prepare statement");
        exit();
    }
    $stmt->execute();       
    $stmt->bind_result(
            $id,       //Hardware ID
            $type ,        //Type ID
            $room,        //Room ID
            $pDate,    //purchase Date
            $warranty,        //Warranty in years
            $manufacturer,  //manufacturer
            $note);     //Notes/Notizen
    
    $allSoftwares = array();
    
    while ($stmt->fetch()) {
        $allSoftwares[] = array(
            "k_id" => $id, 
            "komponentenart_ka_id" => $type,
            "raeume_r_id" => $room,
            "k_einkaufsdatum" => $pDate, 
            "k_gewaehrleistungsdauer" => $warranty, 
            "k_hersteller" => $manufacturer, 
            "k_notiz" => $note);
    }
    
    return $allSoftwares; 
}

/*
 * Diese Funktion fügt eine neue Software der Datenbank hinzu.
 */
function insertSoftware($k_id, $r_id) {
    global $mysqli;
    if($insert_stmt = $mysqli->prepare(
        "INSERT INTO `software_in_raum` (
            `sir_k_id`,
            `sir_r_id`)
        VALUES (
            $k_id,
            $r_id
        )")) {

        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            return -1;
            exit();
        }
    }
    
    return $mysqli->insert_id;
    exit();
}

/*
 * Diese Funktion aktualisert eine bestehende Software in der Datenbank.
 */
function updateSoftware($k_id, $r_id) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare(
        "UPDATE software_in_raum SET
            sir_r_id=$r_id
            WHERE sir_k_id=$k_id")) {
        if (!$insert_stmt->execute()) {
            return false;
            exit();
        }
    }
    
    return true;
    exit();
}

/**
 * Diese Funktion entfernt eine bestehende Software aus der Datenbank.
 */
function removeSoftware($id) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare("DELETE FROM software_in_raum WHERE sir_k_id = $id")) {
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            return false;
            exit();
        }
    }
    
    return true;
    exit();
}
