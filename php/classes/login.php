<?php

/**
 * Diese Funktionen kuemmern sich um die Verarbeitung des Login-Skriptes. 
 * SQL-Abfrage Teams
 * 
 */

/**
 * Einbindung Globaler Konfigurationen
 */
include_once 'db_connect.php';

/*
 * Diese Funktion macht das Login-Skript sicherer.
 * Es verhindert, dass Angreifer auf das Session-id-Cookie mit Hilfe von 
 * JavaScript (zum Beispiel in einem XSS-Angriff) zugreifen können. Auch die 
 * Funktion session_regenerate_id(), die bei jedem erneuten Seitenladen die 
 * Session-id neu erzeugt, hilft das Übernehmen einer Sitzung zu verhindern. 
 * Beachte: Wenn du HTTPS in deiner Login-Anwendung verwendest, dann setze die 
 * Variable "$secure" auf true. In einer Umgebung für Dauernutzung ist es sehr 
 * wichtig, dass du HTTPS verwendest.
 */

function sec_session_start() {
    $session_name = 'sec_session_verwaltung';
    $secure = 'SECURE';

    // Damit wird verhindert, dass JavaScript auf die session id zugreifen kann.
    $httponly = true;

    // Holt Cookie-Parameter.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session "
                . "(ini_set)");
        exit();
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(
            $cookieParams["lifetime"], $cookieParams["path"], 
            $cookieParams["domain"], $secure, $httponly
    );

    // Setzt den Session-Name zu oben angegebenem.
    session_name($session_name);
    session_start();            // Startet die PHP-Sitzung 
    session_regenerate_id();    // Erneuert die Session, löscht die alte.  
}

/**
 * Diese Funktion vergleicht die E-Mail-Adresse und das Passwort mit der 
 * Datenbank. Sie gibt true zurück, wenn es einen entsprechenden Eintrag 
 * gibt. 
 */
function login($username, $password, $mysqli) {
    // Das Benutzen vorbereiteter Statements verhindert SQL-Injektion.
    if (!$stmt = $mysqli->prepare("SELECT id, name, password, salt 
				  FROM anwender 
                                  WHERE name = ? LIMIT 1")) {
        // Die vorbereitete Anweisung konnte nicht erstellt werden
        header("Location: ../error.php?err=Database error: "
                . "cannot prepare statement (login)");
        exit();
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    // hole Variablen von result.
    $stmt->bind_result($user_id, $username, $db_password, $salt);
    $stmt->fetch();

    // hash das Passwort mit dem eindeutigen salt.
    $password = hash('sha512', $password . $salt);
    if ($stmt->num_rows != 1) {
        //Es gibt keinen Benutzer. 
        return false;
    }
    // Wenn es den Benutzer gibt, dann wird überprüft ob das Konto
    // blockiert ist durch zu viele Login-Versuche 
    if (checkbrute($user_id, $mysqli) == true) {
        // Konto ist blockiert 
        // Schicke E-Mail an Benutzer, dass Konto blockiert ist
        return false;
    }
    
    // Überprüfe, ob das Passwort in der Datenbank mit dem vom
    // Benutzer angegebenen übereinstimmt.
    if ($db_password != $password) {
        // Passwort ist nicht korrekt
        // Der Versuch wird in der Datenbank gespeichert
        $now = time();
        if (!$mysqli->query("INSERT INTO login_attempts(userid, time) 
                                    VALUES ('$user_id', '$now')")) {
            header("Location: ../error.php?err=Database error: login_attempts");
            exit();
        }

        return false;
    }
    // Passwort ist korrekt!
    // Hole den user-agent string des Benutzers.
    $user_browser = $_SERVER['HTTP_USER_AGENT'];

    // XSS-Schutz, denn eventuell wir der Wert gedruckt
    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
    $_SESSION['user_id'] = $user_id;

    // XSS-Schutz, denn eventuell wir der Wert gedruckt
    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);

    $_SESSION['username'] = $username;
    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);

    // Login erfolgreich.
    return true;
}

function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();

    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $mysqli->prepare("SELECT time 
                                  FROM login_attempts 
                                  WHERE labuserid = ? AND time > 
                                  '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);

        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();

        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: ../error.php?err=Database error: "
                . "cannot prepare statement (checkbrute)");
        exit();
    }
}

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], $_SESSION['username'], 
            $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT Password 
				      FROM labuser 
				      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Could not prepare statement
            header("Location: ../error.php?err=Database error: "
                    . "cannot prepare statement (login_check)");
            exit();
        }
    } else {
        // Not logged in 
        return false;
    }
}

function esc_url($url) {
    if ('' == $url) {
        return $url;
    }
    
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '',
            $url);
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

//TODO ALEX SCHREIB KOMMENTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function keytablequery($mysqli) {
    // SQL-Query für Schlüsselausgabe
    $res = mysqli_query($mysqli, "SELECT `labuserkey`.ID_Ausleih, T1.ID, T1.Schluessel_Typ, T2.ID, T2.Name, `labuserkey`.FromDay, `labuserkey`.ToDay, `labuserkey`.Abgabe FROM `labuserkey`
						INNER JOIN `key` AS T1 		ON `labuserkey`.KeyID = T1.ID
						INNER JOIN `labuser` AS T2 	ON `labuserkey`.LabUserID = T2.ID
                                                ORDER BY `labuserkey`.ID_Ausleih");

    if (!$res) {
        echo "Query error";
    }

    return $res;
}

//TODO ALEX SCHREIB KOMMENTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function showtableheading($res) {
    //Ausgabe Überschrift
    $numfields = mysqli_num_fields($res);
    $i = 0;
    echo '<table border=1 width=100%><tr>'; //keine ausgaben in den func -> auslagern zu assets!!!
    while ($i < $numfields) {
        $finfo = mysqli_fetch_field_direct($res, $i);
        echo'<th>' . $finfo->name . "</th>";
        $i = $i + 1;
    }
    echo "</tr>";
}

//TODO ALEX SCHREIB KOMMENTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function showtabledata($res) {
    //Ausgabe Tabelleninhalt
    while ($row = mysqli_fetch_array($res)) {
        $y = 0;
        while ($y < (count($row) / 2)) {
            echo "<td>" . $row[$y] . "</td>";
            $y = $y + 1;
        }
        echo "</tr>";
    }
    echo "</table>";
}

//TODO ALEX SCHREIB KOMMENTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function mysqlquery($mysqli, $query) {
    // SQL-Query für Schlüsselausgabe
    $res = mysqli_query($mysqli, $query);

    if (!$res) {
        echo "Query error";
    }

    return $res;
}

//TODO ALEX SCHREIB KOMMENTS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function showdata($res) {
    //Ausgabe Tabelleninhalt
    while ($row = mysqli_fetch_array($res)) {
        $y = 0;
        while ($y < (count($row) / 2)) {
            echo '<option>' . $row[$y] . '</option>';
            $y = $y + 1;
        }
    }
}