<?php
include './php/classes/db_connect.php';
include_once '../dbq/rooms_query.php';

class Room {
    private $func;

    public static function getAllRooms() {
        
    }
    
    public static function insertRoom() {
        if (isset(filter_input(INPUT_POST, 'call_InsertRoom', FILTER_SANITIZE_STRING))) {
            
            $roomID = filter_input(INPUT_POST, 'post_roomID');
            $description = filter_input(INPUT_POST, 'post_description');
            $note = filter_input(INPUT_POST, 'post_note');
            
            insertRooms($roomID, $description, $note);
        }
    }
}