<?php
    include '../php/dbq/all_components_query.php';
    include '../php/dbq/rooms_query.php';
    include '../php/dbq/componentType_query.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include('../fragments/default_includes.php'); ?>
        <title>IT-Verwaltung</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <div class="row row-offcanvas row-offcanvas-left">              
                    <!-- Sidebar -->
                    <?php include('../fragments/navigation_left.php'); ?>
                    <!-- /Sidebar -->
                    
                    <!-- main right col -->
                    <div class="column col-sm-10 col-xs-11" id="main">
                        <div class="container">
                            <h1 class="page-header">
                                Hardwareverwaltung
                            </h1>
                            
                            <table id="" class="table table-responsive">
                              <thead>
                                  <tr>
                                      <th>Type</th>
                                      <th>Raum</th>
                                      <th>Einkaufsdatum</th>
                                      <th>Garantie in Jahren</th>
                                      <th>Hersteller</th>
                                      <th>Beschreibung</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                    $components = getAllComponents();

                                    foreach ($components as $component) {
                                        echo "<tr class='component'>"
                                        . "<td class='hidden'>"
                                        .$component['k_id']
                                        ."</td><td>"
                                        .$component['komponentenart_ka_id']
                                        ."</td><td>"
                                        .$component["raeume_r_id"]
                                        ."</td><td>"
                                        .$component["k_einkaufsdatum"]
                                        ."</td><td>"
                                        .$component["k_gewaehrleistungsdauer"]
                                        ."</td><td>"
                                        .$component["k_hersteller"]
                                        ."</td><td>"
                                        .$component["k_notiz"]
                                        ."</td></tr>";
                                    }
                                ?>
                              </tbody>
                            </table>
                            <form class="pull-right">
                                <button class="btn btn-info" type="button" onclick="Add()">Neu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Komponente hinzufügen</h4>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Type</label>
                                <select name="komponentenart_ka_id" class='form-control'>
                                <?php
                                    $types = getComponentTypes();
                                    foreach($types as $type) {
                                        $typeId = $type["Id"];
                                        $componentType = $type["ComponentType"];
                                        echo("<option value='$typeId'>$componentType</option>");
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Raum</label>
                                <select name="raeume_r_id" class='form-control'>
                                <?php 
                                    $rooms = getRooms();
                                    foreach($rooms as $room) {
                                        $roomId = $room["Id"];
                                        $roomNumber = $room["Number"];
                                        $roomName = $room["Description"];
                                        echo("<option value='$roomId'>$roomNumber - $roomName</option>");
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Einkaufsdatum</label>
                                <div class="input-group">
                                    <input id="datepicker" placeholder="Einkaufsdatum" class="form-control" type="text" name="k_einkaufsdatum"/>
                                    <span class="input-group-addon glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Garantie in Jahren</label>
                                <input placeholder="Garantie" class="form-control" type="number" name="k_gewaehrleistungsdauer"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hersteller</label>
                                <input placeholder="Hersteller" class="form-control" type="text" name="k_hersteller"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Beschreibung</label>
                                <input placeholder="Beschreibung" class="form-control" type="text" name="k_notiz"/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Abbrechen</button>
                            <button type="submit" class="btn btn-success" name="btnInsert">Komponente hinzufügen</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        
        <script>
            $(document).ready(function() {
                /*
                 * Wenn auf einen Eintrag in der Tabelle geklickt wird,
                 * wird die Detail-Seite angezeigt.
                 */
                $('table tr').on('click', function() {
                    id = $(this).find(".hidden").text();
                    var ziel = "./componentItems.php?Id=" + id;
                    window.location.href=ziel;
                });
                
                /*
                 * Erstellt einen auf deutsch Localisierten DatePicker
                 * für das Einkaufsdatum an.
                 */
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    monthNames: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
                    dayNames: ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"],
                    dayNamesShort: ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"],
                    dayNamesMin: ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"],
                });
            });
            
            /*
             * Zeigt das Hinzufügen Modal an wenn der "Neu" Button geklickt wird.
             */
            function Add() {                
                $('#modal-edit').modal('show');
            };
        </script>
    </body>
</html>