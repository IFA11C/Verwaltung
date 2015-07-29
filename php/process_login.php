<?php
include_once './classes/db_connect.php';
include_once './classes/login.php';
sec_session_start(); 

if (isset($_POST['name'], $_POST['p'])) {
    $username = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['p'];  
    if (login($username, $password, $mysqli) == true) {
        header("Location: ../index.php");
        exit();
    } else {
        header('Location: ../login.php?error=1');
        exit();
    }
} else {
    header('Location: ../error.php?err=Could not process login');
    exit();
}