<?php
    include '../php/dbq/rooms_query.php';
    include '../php/dbq/all_components_query.php';
    
    $roomID = filter_input(INPUT_GET, 'Id');
    
    $rooms = getRooms();
    $components = getAllComponents();
    
    foreach ($rooms as $room) {
        if ($room['Id'] == $roomID) {
            //Raum, der in der url übergeben wird, ist selektiert
            $roomName = $room['Number'];
            $roomDescription = $room['Description'];
            $roomNote = $room['Note'];
        }
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include('../fragments/default_includes.php'); ?>
        <title>IT-Verwaltung - Raum bearbeiten</title>
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
                            <h1 class="page-header" id="roomNumber"><?php echo $roomName ?>
                                <a class="btn btn-info pull-right" onclick="EditRoom()">Raum bearbeiten</a></h1>

                            <div class="hardware-info">
                                <?php
                                    if (isset($roomDescription))
                                    {
                                        echo "<h4 id='roomDescription'>Bezeichnung: $roomDescription</h4>";
                                    }
                                
                                    if (isset($roomNote))
                                    {
                                        echo "<h4 id='roomNote'>Notziz: $roomNote</h4>";
                                    }
                                ?>
                            </div>

                            <h3 class="page-header">Komponenten</h3>
                            <table id="" class="table table-responsive">
                              <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Raum</th>
                                      <th>Lieferant</th>
                                      <th>Einkaufsdatum</th>
                                      <th>Garantie in Jahren</th>
                                      <th>Beschreibung</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                        foreach ($components as $component) {
                                            if ($component["Room"] == $roomName) {
                                                echo "<tr><td>"
                                                .$component["Type"]
                                                ."</td><td>"
                                                .$component["Room"]
                                                ."</td><td>"
                                                .$component["Manufacturer"]
                                                ."</td><td>"
                                                .$component["PDate"]
                                                ."</td><td>"
                                                .$component["Warranty"]
                                                ."</td><td>"
                                                .$component["Note"]
                                                ."</td></tr>";
                                            }
                                        }
                                  ?>
                              </tbody>
                            </table>
                            <form class="pull-right">
                                <button class="btn btn-info" type="button" onclick="AddComponent()">Komponente hinzufügen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-component-add" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Komponente hinzufügen</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label class="control-label" for="txtName">Name</label>
                            <input placeholder="Name" id="txtName" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtRoom">Raum</label>
                            <input placeholder="Raum" id="txtRoom" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtSupplier">Lieferant</label>
                            <input placeholder="Lieferant" id="txtSupplier" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtPurchaseDate">Einkaufsdatum</label>
                            <input placeholder="Einkaufsdatum" id="txtPurchaseDate" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtWarrantyInYears">Garantie in Jahren</label>
                            <input placeholder="Garantie" id="txtWarrantyInYears" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtDescription">Beschreibung</label>
                            <input placeholder="Beschreibung" id="txtDescription" class="form-control" type="text"/>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Komponente hinzufügen</button>
                    </div>
                    </div>
                </div>
            </div>
        
            <div class="modal fade" id="modal-room-edit" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Komponente Bearbeiten</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label" for="txtName">Raumnummer</label>
                                <input placeholder="Raumnummer" id="txt-room-RoomNumber" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtRoom">Bezeichnung</label>
                                <input placeholder="Bezeichnung" id="txt-room-Description" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtSupplier">Notiz</label>
                                <input placeholder="Notiz" id="txt-room-Note" class="form-control" type="text"/>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Änderungen verwerfen</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Änderungen speichern</button>
                        </div>
                    </div>
                </div>
            </div>
        
        <script>
            function AddComponent(){
                $('#modal-component-add').modal('show');
            };
            
            function EditRoom(){
                
                //Change content from imput fields
                $('#txtRoomNumber').val($('#roomNumber').text());
                $('#txtDescription').val($('#roomDescription').text());
                $('#txtNote').val($('#roomNote').text());
                
                $('#modal-room-edit').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr').on('click', function(){
                    alert("TODO componentItems aufrufen");
                    //TODO: Open right ComponentItems
                });
            });
        </script>
    </body>
</html>