<?php

/**
 * Diese Funktionen kuemmern sich um die Verarbeitung der Attribute. 
 */

/**
 * Einbindung Globaler Konfigurationen
 */
//include_once 'php/classes/db_connect.php';
include_once '/../classes/db_connect.php';

$error_msg = "";

/**
 * Prüft ob Insert Button gedrückt wurde
 */

if (isset($_POST['btnInsert'])) {
    if (isset($_POST['kat_bezeichnung'])) {
        $kat_bezeichnung = filter_input(INPUT_POST, 'kat_bezeichnung', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($error_msg)) {
            if ($id = insertAttribute($kat_bezeichnung)) {
                header('Location: ../componentsAttributes.php?ID=' . $id);
            } else {
                header('Location: ../err.php?err=Fehler beim einfügen eines Attributs');
            }
            exit();
        }
    }
}

/**
 * Prüft ob Update Button gedrückt wurde
 */

if (isset($_POST['btnUpdate'])) {
    if (isset($_POST['kat_id'], $_POST['kat_bezeichnung'])) {
        $id = filter_input(INPUT_POST, 'kat_id', FILTER_SANITIZE_NUMBER_INT);
        $desc = filter_input(INPUT_POST, 'kat_bezeichnung', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        echo $id.$desc;
        if (empty($error_msg)) {
            if (updateAttribute($id, $desc)) {
                header('Location: ../componentsAttributes.php?ID=' . $id);
            } else {
           //     header('Location: ../../err.php?err=Fehler beim einfügen eines Raumes');
            }
            exit();
        }
    }
}

/**
 * Prüft ob Remove Button gedrückt wurde
 */

if (isset($_POST['btnRemove'])) {
    if (isset($_POST['kat_id'])) {
        $id = filter_input(INPUT_POST, 'kat_id', FILTER_SANITIZE_NUMBER_INT);
        if (empty($error_msg)) {
            if (removeAttribute($id)) {
                
            } else {
                header('Location: ../err.php?err=Fehler beim löschen eines Attributs');
            }

            exit();
        }
    }
}

/**
 * Diese Funktion gibt alle Attribute zurück 
 */

function getAttributes() {
    global $mysqli;
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
        $attributes[] = array("kat_id" => $id, "kat_bezeichnung" => $desc);
    }
    return $attributes; 
}

/**
 * Diese Funktion fügt ein neues Attribut ein
 */
function insertAttribute($desc) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare("INSERT INTO `komponentenattribute` (`kat_bezeichnung`) VALUES ( ?)")) {
        $insert_stmt->bind_param('s', $desc);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            return -1;
            exit();
        }
    }
    return $mysqli->insert_id;

    exit();
}

/**
 * Diese Funktion gibt aktualisiert ein Attribut mit einer bestimmten ID
 */
function updateAttribute($id, $desc) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare("UPDATE komponentenattribute SET kat_bezeichnung=? WHERE kat_id=? ")) {
        $insert_stmt->bind_param('ss', $desc, $id);
        if (!$insert_stmt->execute()) {
            return FALSE;
            exit();
        }
    }
    return true;

    exit();
}

/**
 * Diese Funktion löscht ein Attribut
 */

function removeAttribute($id) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare("DELETE FROM komponentenattribute WHERE kat_id = ?")) {
        $insert_stmt->bind_param('s', $id);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            return FALSE;
            exit();
        }
    }
    return TRUE;

    exit();
}

