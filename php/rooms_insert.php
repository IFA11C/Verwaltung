
<?php

include_once './classes/db_connect.php';
include_once './classes/sec_session.php';
include_once './dbq/rooms_query.php';

sec_session_start();
$error_msg = "";

if (isset($_POST['nbr'], $_POST['name'], $_POST['note'])) {

    $number = filter_input(INPUT_POST, 'nbr', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (empty($error_msg)) {
        if ($id = insertRooms($number, $name, $note, $mysqli)) {
                header('Location: ../room.php?ID=' . $id);
        }  else {
            header('Location: ../error.php?err=Fehler beim einfügen eines Raumes');   
        }
        
        exit();
    }
}