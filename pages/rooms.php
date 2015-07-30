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
                            <button class="btn btn-info pull-right" type="button" onclick="Add()">Neu</button>
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
                        <h4 class="modal-title" id="modalLabel"></h4>
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
                            <button id="modalBtn1" type="button" class="btn btn-warning" data-dismiss="modal"></button>
                            <button id="modalBtn2" type="button" class="btn btn-success" data-dismiss="modal"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            function Add(){
                $('#modalLabel').html("Raum hinzufügen");
                
                //Change button text
                $('#modalBtn1').html("Abbrechen");
                $('#modalBtn2').html("Raum hinzufügen");
                
                //Clear values
                $('#modal-edit').find('input').each( function () {
                    $(this).val('');
                });
                
                $('#modal-edit').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr').on('click', function(){
                    
                    //Change button text
                    $('#modalBtn1').html("Änderungen verwerfen");
                    $('#modalBtn2').html("Änderungen speichern");
                    
                    //Change content from imput fields
                    $('#modalLabel').html($(this).children().eq(1).text());
                    $('#txtRoomNumber').val($(this).children().eq(1).text());
                    $('#txtDescription').val($(this).children().eq(2).text());
                    $('#txtNote').val($(this).children().eq(3).text());
                    
                    $('#modal-edit').modal('show');
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
