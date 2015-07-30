<?php
    include '../php/classes/db_connect.php';
    include '../php/dbq/rooms_query.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include_once('../fragments/default_includes.php'); ?>
        <title>Räume</title>
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
                            <h1 class="page-header">Räume</h1>
                            <table id="rooms" class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nummer</th>
                                        <th>Bezeichnung</th>
                                        <th>Notiz</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $rooms = getRooms();
                                        
                                        foreach ($rooms as $room) {
                                            echo "<tr class='raum'><td>"
                                            .$room['Number']
                                            ."</td><td>"
                                            .$room["Description"]
                                            ."</td><td>"
                                            .$room["Note"]
                                            ."</td></tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <form class="pull-right">
                                <button class="btn btn-info" type="button" onclick="AddRoom()">Neu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-room-add" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Raum hinzufügen</h4>
                    </div>
                    <form action="<?php echo filter_input(INPUT_SERVER, 'PHP_SELF') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label" for="txtName">Raumnummer</label>
                                <input placeholder="Raumnummer" id="txtRoomNumber" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtRoom">Bezeichnung</label>
                                <input placeholder="Bezeichnung" id="txtDescription" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtSupplier">Notiz</label>
                                <input placeholder="Notiz" id="txtNote" class="form-control" type="text"/>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Abbrechen</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Raum hinzufügen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function AddRoom(){
                $('#modal-room-add').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr').on('click', function(){
                    
                    var ziel = "./roomComponents.php?" + id;
                    window.location.href=ziel;
                });
            });

//            $(document).ready(function() {
//                $(".raum").on( "click", function() {
//                    var id = $(this).find(".hidden").text();
//                    console.log("Id: " + id);
//                });
//            });
        </script>
    </body>
</html>
