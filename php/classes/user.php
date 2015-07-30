<?php
include('passwHash.php');
include('../php/dbq/user_query.php');

session_start();

final class User {
    /**
     * Loggt den Benutzer ein wenn das korrekte passwort eingegeben
     * wurde und der Benutzer in der Datenbank existiert.
     */
    public static function Login() {
        if(isset($_POST["username"]) && isset($_POST["password"])) {
            $localUsername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
            
            $user = getUser($localUsername);
            if(isset($user)) {
                $corretPassword = $user["Password"];
                
                if(validate_password($password, $corretPassword)) {
                    $_SESSION["Username"] = $localUsername;
                    $role = getRoleById($user["Rolle"]);
                    $_SESSION["Role"] = $role["Bezeichnung"];
                    header("Location: ../pages/index.php");
                    return;
                }
            }
        }
        
        header("Location: ../pages/login.php?code=1337");
    }
    
    /**
     * Meldet den derzeitig angemeldeten Benutzer ab und leitet auf die Login Seite weiter.
     */
    public static function Logout() {
        $_SESSION["Username"] = '';
        $_SESSION["Role"] = '';
        
        header("Location: ../pages/login.php?code=41");
    }
    
    /**
     * Gibt den Benutzernamen des angemeldeten Benutzers zurück.
     */
    public static function getUsername() {
        return $_SESSION["Username"];
    }
    
    /**
     * Gibt die Role des angemeldeten Benutzers zurück.
     */
    public static function getRole() {
        return $_SESSION["Role"];
    }
    
    /**
     * Prüft ob der derzeitig angemeldete Benutzer die entsprechenden Rechte hat und 
     * leitet auf die Login Seite weiter falls dies nicht der fall ist.
     */
    public static function requiresRole($requiredRole) {
        if(self::hasPermission($requiredRole)) {
            return;
        }
        else {
            header("Location: ../pages/login.php?code=403");
        }
    }
    
    /**
     * Prüft ob der derzeitig angemeldete Benutzer eine Rolle besitzt die ausreichende Rechte
     * besitzt oder ob seine Rolle mehr Rechte hat als die erforderliche Rolle.
     */
    private function hasPermission($roleToCheck) {
        //Umso geringer der Wert umso mehr Rechte hat eine Rolle.
        $RoleHierarchy = array(
            "debug rolle" => 0,
            "admin" => 1,
            "lehrer" => 2
        );
        
        if(isset($RoleHierarchy[strtolower(self::getRole())])) {
            $userRole = $RoleHierarchy[strtolower(self::getRole())];
            $role = $RoleHierarchy[strtolower($roleToCheck)];
            
            if($userRole <= $role) {
                return true;
            }    
        }
        
        return false;
    }
}
