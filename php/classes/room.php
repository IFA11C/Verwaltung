<?php
include './php/classes/db_connect.php';
include_once '../dbq/rooms_query.php';

class Room {
    private $func;

    public static function getAllRooms() {
        echo "test";
    }
    
    public static function insertRoom($roomID, $description, $note) {
        if (isset(filter_input(INPUT_POST, 'call_InsertRoom', FILTER_SANITIZE_STRING))) {
            insertRooms($roomID, $description, $note);
        }
    }
}