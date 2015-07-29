<?php
/**
 * Das ist der PHP-Code, den wir benutzen um uns mit der MySQL-Datenbank
 * zu verbinden.
 * 
 * Inizalisieren des zentralen mysqli Objektes und verbinden mit der Datenbank
 * Setzen des Charsets UTF-8
 */

define("HOST", "localhost"); 			// The host you want to connect to. 
define("USER", "root"); 		// The database username. 
define("PASSWORD", "");                      // The database password. 
define("DATABASE", "itv_v02");                   // The database name.

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

