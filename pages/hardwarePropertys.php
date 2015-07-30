<?php
    include '../php/classes/db_connect.php';
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
                            <h1 class="page-header">Hardware Eigenschaften</h1>

                            <table class="table table-responsive">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Beschreibung</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td>CPU</td>
                                      <td>Prozessor</td>
                                  </tr>
                                  <tr>
                                      <td>2</td>
                                      <td>CPU</td>
                                      <td>Prozessor</td>
                                  </tr>
                                  <tr>
                                      <td>3</td>
                                      <td>CPU</td>
                                      <td>Prozessor</td>
                                  </tr>
                                  <tr>
                                      <td>4</td>
                                      <td>CPU</td>
                                      <td>Prozessor</td>
                                  </tr>
                              </tbody>
                            </table>
                            <form class="pull-right">
                                <button class="btn btn-info" type="button" onclick="AddHardwareProperty()">Neu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-hardware-property" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-hardware-property-label"></h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label class="control-label" for="txtName">Name</label>
                            <input placeholder="Name" id="txtName" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtDescription">Beschreibung</label>
                            <input placeholder="Beschreibung" id="txtDescription" class="form-control" type="text"/>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button id="modal-hardware-property-btn-1" type="button" class="btn btn-warning" data-dismiss="modal"></button>
                        <button id="modal-hardware-property-btn-2" type="button" class="btn btn-success" data-dismiss="modal"></button>
                    </div>
                    </div>
                </div>
            </div>
        
        <script>
            function AddHardwareProperty(){
                $('#modal-hardware-property-label').html("Eigenschaft hinzufügen");
                
                //Change button text
                $('#modal-hardware-property-btn-1').html("Abbrechen");
                $('#modal-hardware-property-btn-2').html("Eigenschaft hinzufügen");
                
                //Clear values
                $('#modal-hardware-property').find('input').each( function () {
                    $(this).val('');
                });
                
                $('#modal-hardware-property').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr').on('click', function(){
                    
                    $('#modal-hardware-property-label').html("Hardware bearbeiten");
                    
                    //Change button text
                    $('#modal-hardware-property-btn-1').html("Änderungen verwerfen");
                    $('#modal-hardware-property-btn-2').html("Änderungen speichern");
                    
                    //Change content from imput fields
                    $('#txtName').val($(this).children().eq(1).text());
                    $('#txtDescription').val($(this).children().eq(2).text());
                    
                    $('#modal-hardware-property').modal('show');
                });
            });
        </script>
    </body>
</html>