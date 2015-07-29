<?php
    include '../php/classes/db_connect.php';
    include '../php/classes/user.php';
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $func = filter_input(INPUT_POST, "post_func");
        
        if ($func == "insertRoom")
        {
            Room::insertRoom();
        }
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include('../fragments/default_includes.php'); ?>
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
                                        <th class="hidden">Id</th>
                                        <th>Nummer</th>
                                        <th>Bezeichnung</th>
                                        <th>Notiz</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="raum">
                                        <td class="hidden">1</td>
                                        <td>r102</td>
                                        <td>Labor</td>
                                        <td></td>
                                    </tr>
                                    <tr class="raum">
                                        <td class="hidden">2</td>
                                        <td>r105</td>
                                        <td>Werkstatt</td>
                                        <td>Keine Computer vorhanden.</td>
                                    </tr>
                                    <tr class="raum">
                                        <td class="hidden">3</td>
                                        <td>r201</td>
                                        <td>IT</td>
                                        <td>Eine Notiz</td>
                                    </tr>
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
                        <h4 class="modal-title" id="modalLabel"></h4>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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
                        <input type="hidden" name="func" value="insertRoom" />
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
