<?php
    include '../php/dbq/rooms_query.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include_once('../fragments/default_includes.php'); ?>
        <script src="../js/jsform.js"></script>
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
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $rooms = getRooms();
                                        
                                        foreach ($rooms as $room) {
                                            echo("
                                                <tr class='raum'>
                                                    <td class='hidden'>".$room['Id']."</td>
                                                    <td class='clickable'>".$room['Number']."</td>
                                                    <td class='clickable'>".$room["Description"]."</td>
                                                    <td class='clickable'>".$room["Note"]."</td>
                                                    <td class='delete-column'>
                                                        <button name='btnRemove' class='delete-button pull-right'><span class='glyphicon glyphicon-remove-sign'></span>
                                                    </td>
                                                </tr>"
                                             );
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
                $('table tr .clickable').on('click', function(){
                    var id = $(this).parent().find(".hidden").text();
                    var ziel = "./roomComponents.php?Id=" + id;
                    window.location.href = ziel;
                });
                
                $('table tr .delete-column').on('click', function(){
                    var id = $(this).parent().find(".hidden").text();
                    postDelete(id);
                });
            });
            
            function postDelete(id) {
                // The rest of this code assumes you are not using a library.
                // It can be made less wordy if you use one.
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "<?php echo($_SERVER["PHP_SELF"]); ?>");
                
                var idField = addHiddenField("nid", id);
                var btnRemove = addHiddenField("btnRemove", 1);
                form.appendChild(btnRemove);
                form.appendChild(idField);
                
                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </body>
</html>
