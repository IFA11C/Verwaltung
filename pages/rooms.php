<?php
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
                                            echo "<tr class='raum'><td class='hidden'>"
                                            .$room['Id']
                                            ."</td><td>"
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
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Raumnummer</label>
                                <input placeholder="Raumnummer" name="nbr" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Bezeichnung</label>
                                <input placeholder="Bezeichnung" name="name" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Notiz</label>
                                <input placeholder="Notiz" name="note" class="form-control" type="text"/>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Abbrechen</button>
                            <button type="submit" class="btn btn-success" name="btnInsert">Raum hinzufügen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            function AddRoom(){
                $('#modal-room-add').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr').on('click', function(){
                    id = $(this).find(".hidden").text();
                    var ziel = "./roomComponents.php?Id=" + id;
                    window.location.href=ziel;
                });
            });
        </script>
    </body>
</html>
