<?php
include_once '../php/classes/db_connect.php';

/*
 * Wenn der Hinzufügen Knopf auf der Seite gedrückt wurde werden die Formular Felder
 * ausgelesen und eine neue Komponente mit den entsprechenden Werten wird in der
 * Datenbank angelegt.
 */
if (isset($_POST['btnInsert'])) {
    if (isset($_POST['komponentenart_ka_id'], $_POST['raeume_r_id'], $_POST['k_einkaufsdatum'], $_POST['k_gewaehrleistungsdauer'], $_POST['k_hersteller'], $_POST['k_notiz'])) {
        $komponentenart_ka_id = filter_input(INPUT_POST, 'komponentenart_ka_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $raeume_r_id  = filter_input(INPUT_POST, 'raeume_r_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_einkaufsdatum = filter_input(INPUT_POST, 'k_einkaufsdatum', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_gewaehrleistungsdauer = filter_input(INPUT_POST, 'k_gewaehrleistungsdauer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_hersteller = filter_input(INPUT_POST, 'k_hersteller', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $k_notiz = filter_input(INPUT_POST, 'k_notiz', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($error_msg)) {
            if ($id = insertComponent(
                $komponentenart_ka_id,
                $raeume_r_id,
                $k_einkaufsdatum,
                $k_gewaehrleistungsdauer,
                $k_hersteller,
                1, //Es gibt nur einen Lieferanten der nicht gewählt werden soll.
                $k_notiz)) {
                
                header("Location: ./component.php");
            } else {
                 header("Location: ./err.php?err=Fehler beim erstellen der Komponente.");
            }
            exit();
        }
    }
}

/**
 * Diese Funktion gibt alle Komponenten zurück 
 */
function getAllComponents() {
    global $mysqli;
    if (!$stmt = $mysqli->prepare(
            "SELECT k.k_id, ka.ka_komponentenart, r.r_nr, k.k_einkaufsdatum, "
            . "k.k_gewaehrleistungsdauer, k.k_hersteller, k.k_notiz "
            . "FROM komponenten k "
            . "inner join komponentenarten ka "
            . "on k.komponentenarten_ka_id = ka.ka_id "
            . "left join raeume r on r.r_id = k.raeume_r_id ")) {
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
    
    $allComponents = array();
    
    while ($stmt->fetch()) {
        $allComponents[] = array(
            "k_id" => $id, 
            "komponentenart_ka_id" => $type,
            "raeume_r_id" => $room,
            "k_einkaufsdatum" => $pDate, 
            "k_gewaehrleistungsdauer" => $warranty, 
            "k_hersteller" => $manufacturer, 
            "k_notiz" => $note);
    }
    return $allComponents; 
}

function insertComponent($komponentenart_ka_id, $raeume_r_id, $k_einkaufsdatum, $k_gewaehrleistungsdauer, $k_hersteller, $lieferant_l_id, $k_notiz) {
    global $mysqli;
    if($insert_stmt = $mysqli->prepare(
        "INSERT INTO `komponenten` (
            `komponentenarten_ka_id`,
            `raeume_r_id`,
            `k_einkaufsdatum`,
            `k_gewaehrleistungsdauer`,
            `k_hersteller`,
            `lieferant_l_id`,
            `k_notiz`)
        VALUES (
            $komponentenart_ka_id,
            $raeume_r_id,
            '$k_einkaufsdatum',
            $k_gewaehrleistungsdauer,
            '$k_hersteller',
            $lieferant_l_id,
            '$k_notiz'
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