<h1>Installation</h1>
<h3>Xampp</h3>
<p>Am einfachsten kann man das Projekt nutzen indem man sich von https://www.apachefriends.org/de/download.html Xampp herunterlädt und installiert.</p>
<p>Nach der erfolgreichen installation können der Apache und MySQL Server gerstartet werden siehe Grafik.</p>
![alt tag](http://screenshots.s32cdn.com/20/198081/5600.png)

<h3>Datenbank</h3>
<p>Um die notwendigen Tabellen in die MySQL Datenbank einzuspielen muss lediglich der SQL Dump eingespielt werden der im "dev" Verzeichnis zu finden ist.</p>
<p>Um einen SQL Dump in einer MySQL Datenbank einzuspielen können mehrere Tools verwendet werden im folgenden wird als Beispiel phpMyAdmin verwendet da es bei Xampp inbegriffen ist.</p>
1. Einen Webbrowser öffnen und auf http://localhost/phpMyAdmin navigieren.
2. In der oberen Menuzeile auf "Importieren" klicken.
3. Auf den "Durchsuchen" Knopf drücken und den SQL Dump aufwählen.
4. Mit "Ok" bestätigen.

<p>Wenn der Dump erfolgreich eingespielt wurde sollte eine Datenbank/Schema mit dem Namen "itv_v02" vorhanden sein mit den folgenden Tabellen.</p>
* benutzer
* benutzer_rollen
* komponenten
* komponentenarten
* komponentenattribute
* komponente_hat_attribute
* lieferant
* raeume
* software_in_raum
* wird_beschrieben_durch

<h3>Datenbank verbinding zu PHP</h3>
<p>Um sicher zu stellen das auf die Richtige Datenbank verbunden wird, mussen die Werte in dem "db_connect.php" angepasst werden. Diese Datei ist im Verzeichnis "php/classes/" zu finden.</p>
<p>Folgenede werte müssen entsprechend angepasst werden, diese Werte werden Standartmäßig verwendet:</p>
```php
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "itv_v02");
```

<h3>Aufrufen der Seite und Anmelden</h3>
<p>Um die Seite aufzurufen muss das Repository im "htdocs" Verzeichnis von Xampp liegen.</p>
![alt tag](http://i.imgur.com/orlGRt8.png)
<p>Wenn dies der fall ist kann die Anwendung über http://localhost/Verwaltung/pages/index.php aufgerufen werden. Allerdings ist die Index-Seite geschützt und kann nur von Benutzern mit den entsprechenden Rechten aufgerufen werden. Im falle der Index-Seite reicht es wenn ein Benutzer die Rolle "Lehrer" hat. Es gibt Standartmäßig folgende Benutzer mit folgenden Rollen und Passwörtern.</p>
| Benutzername  | Passwort      | Rolle       |
| ------------- | ------------- | ----------- |
| Testuser      | 1234          | DEBUG Rolle |
| Admin1        | Admin1        | Admin       |
| Lehrer1       | Lehrer1       | Lehrer      |
<p>Rollen verhalten sich Hierarchisch wie folgt:</p>
DEBUG Rolle > Admin > Lehrer

<h3>Nicht Implementierte Funktionalitäten</h3>
<p>Folgende Funktionalitäten sind nicht Implementiert:</p>
* Schutz anderer Seiten oder Aktionen nach Benutzerrechten. (Siehe index.php für ein Beispiel wie diese Funktionalität ergänzt werden kann.) 
* Komponenten ausmustern
* Benutzerverwaltung e.g. Benutzer erstellen/ändern/löschen.
* Räume -> Raum -> Komponente Hinzufügen
* Komponenten -> Komponente -> Bearbeiten
* Komponenten -> Komponente -> Eigenschaften: Hinzufügen
* Startseite -> Letzte Aktivitäten (Optionale funktionalität, benötigt neu Datenbank Tabellen)
