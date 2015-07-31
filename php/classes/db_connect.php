<?php
/**
 * Dieser PHP-Code, wir benutzen um sich mit der
 * MySQL-Datenbank zu verbinden.
 * 
 * Initialisieren des zentralen mysqli Objektes,
 * Verbinden mit der Datenbank und setzen des
 * Encodings UTF-8.
 */

//Der Addresse des Computers wo der Datenbank Server läuft.
define("HOST", "localhost"); 
//Der Benutzername für die Datenbank.
define("USER", "root");
//Das Passwort für die Datenbank.
define("PASSWORD", "");
//Der Name der Datenbank/Schema.
define("DATABASE", "itv_v02");

//Verbindung aufbauen
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

/*
 * Falls ein Fehler beim Verbindungsaufbau entsteht
 * wird eine Fehlermeldung angezeigt.
 */
if ($mysqli->connect_error) {
    header("Location: ./err.php?err=Fehler beim herstellen der Verbindung mit dem MySQL Server.");
    exit();
}

/*
 * Falls ein Fehler beim setzen des Encodings
 * entsteht wird eine Fehlermeldung angezeigt.
 */
if (!$mysqli->set_charset("utf8")) {
    header("Location: ./err.php?err=Fehler beim setzen des Encodings.");
    exit();
}

