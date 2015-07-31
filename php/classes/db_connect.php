<?php
/**
 * Das ist der PHP-Code, den wir benutzen um uns mit der MySQL-Datenbank
 * zu verbinden.
 * 
 * Inizalisieren des zentralen mysqli Objektes und verbinden mit der Datenbank
 * Setzen des Charsets UTF-8
 */

//Team-Server
define("HOST", "192.168.10.1");
define("USER", "ultralord");
define("PASSWORD", "1234");
define("DATABASE", "itv_v02");

/*
//Localer Xampp Server
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "itv_v02");
*/

//
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

