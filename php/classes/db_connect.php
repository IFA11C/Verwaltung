<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'itv_v02';

//Verbindung aufbauen
$db = new mysqli($server, $user, $pass, $database);

//Fehlerabfrage
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

/*
//Query aufbauen
$sql = <<<SQL
    SELECT *
    FROM `raeume`
SQL;

//Query Fehlerabfrage
if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

//Abfrage ausgeben
while($row = $result->fetch_assoc()){
    echo $row['r_id'] . '<br />';
}

//Anzahl erhaltener werte anzeigen lassen
echo 'Total results: ' . $result->num_rows;

//Results löschen
$result->free();

//Verbindung beenden
$db->close();
 */