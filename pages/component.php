<?php
    include '../php/dbq/all_components_query.php';
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
                                      <th>Lieferant</th>
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
                        <h4 class="modal-title" id="modalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label class="control-label" for="txtName">Name</label>
                            <input placeholder="Name" id="txtName" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtType">Typ</label>
                            <input placeholder="Raum" id="txtType" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtRoom">Raum</label>
                            <input placeholder="Lieferant" id="txtRoom" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtPurchaseDate">Einkaufsdatum</label>
                            <input placeholder="Einkaufsdatum" id="txtPurchaseDate" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtWarranty">Garantie in Jahren</label>
                            <input placeholder="Garantie" id="txtWarranty" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtManufacturer">Lieferant</label>
                            <input placeholder="Garantie" id="txtManufacturer" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="txtDescription">Beschreibung</label>
                            <input placeholder="Beschreibung" id="txtDescription" class="form-control" type="text"/>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button id="modalBtn1" type="button" class="btn btn-warning" data-dismiss="modal"></button>
                        <button id="modalBtn2" type="button" class="btn btn-success" data-dismiss="modal"></button>
                    </div>
                    </div>
                </div>
            </div>
        
        <script>
            function Add(){
                $('#modalLabel').html("Komponente hinzufügen");
                
                //Change button text
                $('#modalBtn1').html("Abbrechen");
                $('#modalBtn2').html("Komponente hinzufügen");
                
                //Clear values
                $('#modal-edit').find('input').each( function () {
                    $(this).val('');
                });
                
                $('#modal-edit').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr').on('click', function(){
                    id = $(this).find(".hidden").text();
                    var ziel = "./componentItems.php?Id=" + id;
                    window.location.href=ziel;
                });
            });
        </script>
    </body>
</html>