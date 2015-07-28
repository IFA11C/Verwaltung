<?php
/**
 * Das ist der PHP-Code, den wir benutzen um uns mit der MySQL-Datenbank
 * zu verbinden.
 * 
 * Inizalisieren des zentralen mysqli Objektes und verbinden mit der Datenbank
 * Setzen des Charsets UTF-8
 */

include_once '/../config/#psl-config.php'; 

//Verbindung aufbauen
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);


if ($mysqli->connect_error) {
    header("Location: ./err.php?err=Unable to connect to MySQL");
    exit();
}
if (!$mysqli->set_charset("utf8")) {
    header("Location: ./err.php?err=Unable to set charset");
    exit();
}

