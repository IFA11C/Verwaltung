<?php
include './php/classes/db_connect.php';
include './php/dbq/rooms_query.php';
include './php/dbq/attribute_query.php';
echo '<br/> <b>Räume:</b> <br/>';

$rooms = getRooms();
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"] . $room["Number"]  . $room["Description"] . $room["Note"].'<br/>';
}

$attribute = getAttributes();
foreach ($attribute as $item) {
    echo ' kat_id ' . $item["kat_id"] . $item["kat_bezeichnung"] . '<br/>';
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
            <!--<table>
                <?php
                    $rooms = getRooms();

                    do
                    {
                        $id = $rooms["Id"];
                        $nr = $rooms["Number"];
                        $des = $rooms["Description"];
                        $note = $rooms["Note"];

                        echo "<tr><td>$id</td><td>$nr</td><td>$des</td><td>$note</td>";

                    } while ($id != NULL)
                ?>
            </table>-->
        </div>
    </body>
</html>
 
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <div class="container">
            <form method="post" action="php/dbq/attribute_query.php">
                <input type="text" name="kat_id" placeholder="">
                <input type="text" name="kat_bezeichnung" placeholder="">
                <button name="btnInsert" type="submit" class="btn btn-primary">I</button>
                <button name="btnUpdate" type="submit" class="btn btn-primary">U</button>
                <button name="btnRemove" type="submit" class="btn btn-primary">D</button>
            </form>
        </div>
    </body>
</html>
