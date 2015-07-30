<?php
include 'php/dbq/rooms_query.php';
include 'php/dbq/all_components_query.php';
echo '<br/> <b>Räume:</b> <br/>';

$rooms = getRooms();
foreach ($rooms as $room) {
    echo ' raum ' . $room["Id"] . $room["Number"] . $room["Description"] . $room["Note"] . '<br/>';
}
$components = getAllComponents();
foreach ($components as $component) {
    echo ' a ' . $component["k_id"] . $component["komponentenart_ka_id"] . $component["raeume_r_id"] . $component["k_einkaufsdatum"] . '<br/>';
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
            <form method="post" action="php/dbq/all_components_query.php">
                <input type="text" name="komponentenart_ka_id" placeholder="komponentenart_ka_id">
                <input type="text" name="raeume_r_id" placeholder="raeume_r_id">
                <input type="text" name="k_einkaufsdatum" placeholder="k_einkaufsdatum">
                <input type="text" name="k_gewaehrleistungsdauer" placeholder="k_gewaehrleistungsdauer">
                <input type="text" name="k_hersteller" placeholder="k_hersteller">
                <input type="text" name="k_notiz" placeholder="k_notiz">
                <button name="btnInsert" type="submit" class="btn btn-primary">I</button>
                <button name="btnUpdate" type="submit" class="btn btn-primary">U</button>
                <button name="btnRemove" type="submit" class="btn btn-primary">D</button>
            </form>
          
            <!--<table>
            <?php
            $rooms = getRooms();

            do {
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
