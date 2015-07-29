<?php
include './php/classes/db_connect.php';
include './php/dbq/rooms_query.php';
echo '<br/> <b>Räume:</b> <br/>';
$rooms = getRooms($mysqli);
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"] . '<br/>';
}
?>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <div class="container">
            <form method="post" action="php/rooms_insert.php">
                <input type="text" name="nbr" placeholder="nummer">
                <input type="text" name="name" placeholder="nummer">
                <input type="text" name="note" placeholder="nummer">
                <button type="submit" class="btn btn-primary">Anlegen</button>
            </form>
        </div>
    </body>
</html>
