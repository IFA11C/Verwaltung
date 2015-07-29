<?php
include './php/classes/db_connect.php';
include './php/dbq/rooms_query.php';
echo '<br/> <b>Räume:</b> <br/>';
$rooms = getRooms($mysqli);
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"] . $room["Number"]  . $room["Description"] . $room["Note"].'<br/>';
}
?>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <div class="container">
            <form method="post" action="php/dbq/rooms_query.php">
                <input type="text" name="nid" placeholder="">
                <input type="text" name="nbr" placeholder="">
                <input type="text" name="name" placeholder="">
                <input type="text" name="note" placeholder="">
                <button name="btnInsert" type="submit" class="btn btn-primary">I</button>
                <button name="btnUpdate" type="submit" class="btn btn-primary">U</button>
                <button name="btnRemove" type="submit" class="btn btn-primary">D</button>
            </form>
        </div>
    </body>
</html>
