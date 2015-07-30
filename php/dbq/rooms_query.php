<?php
include_once('../php/classes/db_connect.php');

$error_msg = "";

/*
 * Wenn der Hinzufügen Knopf auf der Seite gedrückt wurde werden die Formular Felder
 * ausgelesen und ein neuer Raum mit den entsprechenden Werten wird in der Datenbank
 * angelegt.
 */
if(isset($_POST['btnInsert'])) {
    if (isset($_POST['nbr'], $_POST['name'], $_POST['note'])) {
        $number = filter_input(INPUT_POST, 'nbr', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (empty($error_msg)) {
            if ($id = insertRooms($number, $name, $note)) {
                header('Location: roomComponents.php?Id=' . $id);
            } else {
                header('Location: ./err.php?err=Fehler beim erstellen des Raumes');
            }
            exit();
        }
    }
}

/*
 * Wenn der Änderungen speichern Knopf auf der Seite gedrückt wurde werden die
 * Formular Felder ausgelesen und die Werte des entsprechende Raumes werden
 * aktualisert.
 */
if (isset($_POST['btnUpdate'])) {
    if (isset($_POST['nid'], $_POST['nbr'], $_POST['name'], $_POST['note'])) {
        $id = filter_input(INPUT_POST, 'nid', FILTER_SANITIZE_NUMBER_INT);
        $number = filter_input(INPUT_POST, 'nbr', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (empty($error_msg)) {
            if (updateRoom($id, $number, $name, $note)) {
                header('Location: roomComponents.php?Id=' . $id);
            } else {
                header('Location: ./err.php?err=Fehler beim aktualiseren des Raumes');
            }
            exit();
        }
    }
}

/*
 * Wenn der Löschen Knopf auf der Seite gedrückt wurde
 * wird der entsprechende Raum aus der Datenbank entfernt.
 */
if (isset($_POST['btnRemove'])) {
    if (isset($_POST['nid'])) {
        $id = filter_input(INPUT_POST, 'nid', FILTER_SANITIZE_NUMBER_INT);
        if (empty($error_msg)) {
            if (removeRoom($id)) {
                header('Location: ./rooms.php');
            } else {
                header('Location: ./err.php?err=Fehler beim entfernen des Raumes');
            }

            exit();
        }
    }
}

function getRoom($id) {
    global $mysqli;
    if (!$stmt = $mysqli->prepare("SELECT distinct * FROM raeume where r_id = $id")) {
        // Could not create a prepared statement
        header("Location: ./err.php?err=Database error: cannot prepare statement");
        exit();
    }
    
    $stmt->execute();
    $stmt->bind_result($id, $nr, $description, $note);
    $room = array();
    
    while ($stmt->fetch()) {
        $room = array("Id" => $id, "Number" => $nr, "Description" => $description, "Note" => $note);
    }
    
    return $room;   
}

/**
 * Diese Funktion gibt alle Räume zurück.
 */
function getRooms() {
    global $mysqli;
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

/*
 * Diese Funktion fügt einen neuen Raum der Datenbank hinzu.
 */
function insertRooms($number, $name, $note) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare("INSERT INTO `raeume` (`r_nr`, `r_bezeichnung`,`r_notiz`) VALUES ( ?, ?, ?)")) {
        $insert_stmt->bind_param('sss', $number, $name, $note);
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
 * Diese Funktion aktualisert einen bestehenden Raum in der Datenbank.
 */
function updateRoom($id, $number, $name, $note) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare("UPDATE raeume SET r_nr=?, r_bezeichnung=?, r_notiz=? WHERE r_id=? ")) {
        $insert_stmt->bind_param('ssss', $number, $name, $note, $id);
        if (!$insert_stmt->execute()) {
            return false;
            exit();
        }
    }
    return true;

    exit();
}

/**
 * Diese Funktion entfernt einen bestehenden Raum aus der Datenbank.
 */
function removeRoom($id) {
    global $mysqli;
    if ($insert_stmt = $mysqli->prepare("DELETE FROM raeume WHERE r_id = ?")) {
        $insert_stmt->bind_param('s', $id);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            return false;
            exit();
        }
    }
    return true;

    exit();
}
