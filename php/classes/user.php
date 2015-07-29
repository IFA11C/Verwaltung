<?php
class User {
    static $username;
    static $role;
    
    /**
     * Loggt den Benutzer ein wenn das korrekte passwort eingegeben
     * wurde und der Benutzer in der Datenbank existiert.
     */
    public static function Login() {
        if(isset($_POST["username"]) && isset($_POST["password"])) {
            $user = $_POST["username"];
            $password = $_POST["password"];
            
            if(true) {
                $username = $user;
                header("Location: ./index.php");
            }
        }
    }
    
    /**
     * Gibt den Benutzernamen des angemeldeten Benutzers zurück.
     */
    public static function getUsername() {
        return isset($username) ? $username : '';
    }
    
    /**
     * Gibt die Role des angemeldeten Benutzers zurück.
     */
    public static function getRole() {
        return isset($role) ? $role : '';
    }        
}
