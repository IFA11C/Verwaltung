<?php
    include '../php/dbq/component_query.php';
    include '../php/dbq/all_components_query.php';
    include '../php/dbq/attribute_query.php';
    
    $componentID = filter_input(INPUT_GET, 'Id');
    $components = getHardwareAttribute($componentID);
    $component = [];
    if(!empty($components)){
        $component = $components[0];
    }
    $attributes = getAttributes();
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
                                <?php if(!empty($components))
                                    {
                                        echo '<span id="componentName">'
                                        .$component['Type']
                                        .'</span>';
                                    } 
                                ?> 
                                <a class="btn btn-info pull-right" onclick="EditComponent()">Bearbeiten</a>
                            </h1>

                            <div class="hardware-info">
                                <div class="row heightFix">
                                    <div class="col col-lg-6">
                                        <?php
                                            if(!empty($components)){
                                                if (isset($component['Room']))
                                                {
                                                    echo "<h4>Raumnummer: <span id='room'>"
                                                    .$component['Room']
                                                    ."</span></h4>";
                                                }

                                                if (isset($component['PDate']))
                                                {
                                                    echo "<h4>Einkaufsdatum: <span id='purchaseDate'>"
                                                    .$component['PDate']
                                                    ."</span></h4>";
                                                }
                                                if (isset($component['Warranty']))
                                                {
                                                    echo "<h4>Garantie in Jahren: <span id='warranty'>"
                                                    .$component['Warranty']
                                                    ."</span></h4>";
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col col-lg-6">
                                        <?php
                                            if(!empty($components)){
                                                if (isset($component['Manufacturer']))
                                                {
                                                    echo "<h4>Lieferant: <span id='manufacturer'>"
                                                    .$component['Manufacturer']
                                                    ."</span></h4>";
                                                }

                                                if (isset($component['Note']))
                                                {
                                                    echo "<h4>Beschreibung: <span id='note'>"
                                                    .$component['Note']
                                                    ."</span></h4>";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <h3 class="page-header">Eigenschaften </h3>
                            <table class="table table-responsive">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Beschreibung</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                    if(!empty($components)){
                                        foreach ($components as $component) {
                                            echo "<tr class='component'><td>"
                                            .$component['AttributID']
                                            ."</td><td>"
                                            .$component['Description']
                                            ."</td><td>"
                                            .$component["Value"]
                                            ."</td></tr>";
                                        }
                                    }
                                ?>
                              </tbody>
                            </table>
                            <form class="pull-right">
                                <button class="btn btn-info" type="button" onclick="AddProperty()">Hinzufügen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-component-edit" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Komponente bearbeiten</h4>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST"> 
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label" for="txtName">Name</label>
                                <input placeholder="Name" id="txtName" class="form-control" type="text" name="komponentenart_ka_id" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtRoom">Raum</label>
                                <input placeholder="Raum" id="txtRoom" class="form-control" type="text" name="raeume_r_id" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtSupplier">Lieferant</label>
                                <input placeholder="Lieferant" id="txtSupplier" class="form-control" type="text" name="k_hersteller" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtPurchaseDate">Einkaufsdatum</label>
                                <input placeholder="Einkaufsdatum" id="txtPurchaseDate" class="form-control" type="text" name="k_einkaufsdatum" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtWarrantyInYears">Garantie in Jahren</label>
                                <input placeholder="Garantie" id="txtWarranty" class="form-control" type="text" name="k_gewaehrleistungsdauer" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtDescription">Beschreibung</label>
                                <input placeholder="Beschreibung" id="txtDescription" class="form-control" type="text" name="k_notiz" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Änderungen verwerfen</button>
                            <button type="submit" class="btn btn-success" name="btnUpdate">Änderungen speichern</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-add-component-attribute" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Eigenschaft hinzufügen</h4>
                    </div>
                    <div class="modal-body">
                        
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Hardware</a></li>
                            <li><a data-toggle="tab" href="#menu1">Software</a></li>
                         </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="form-group">
                                    <?php if(!empty($attributes))
                                    {
                                        foreach($attributes as $attribute) {
                                            $id = $attribute["kat_id"];
                                            $description = $attribute["kat_bezeichnung"];
                                            echo '<div class="checkbox"><label><input type="checkbox" name="'
                                            .$id
                                            .'">'
                                            .$description
                                            . '</label></div>';    
                                        }
                                    } 
                                    ?> 
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="form-group">
                                    <?php if(!empty($attributes))
                                    {
                                        foreach($attributes as $attribute) {
                                            $id = $attribute["kat_id"];
                                            $description = $attribute["kat_bezeichnung"];
                                            echo '<div class="checkbox"><label><input type="checkbox" name="'
                                            .$id
                                            .'">'
                                            .$description
                                            . '</label></div>';    
                                        }
                                    } 
                                    ?> 
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Eigenschaft hinzufügen</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        <script>
            function EditComponent(){                
                
                //Change content from imput fields
                $('#txtName').val($('#componentName').text());
                $('#txtRoom').val($('#room').text());
                $('#txtSupplier').val($('#manufacturer').text());
                $('#txtPurchaseDate').val($('#purchaseDate').text());
                $('#txtWarranty').val($('#warranty').text());
                $('#txtDescription').val($('#note').text());
                
                $('#modal-component-edit').modal('show');
            };
            
            function AddProperty(){                
                $('#modal-add-component-attribute').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr').on('click', function(){
                    
                    //Change button text
                    $('#modalBtn1').html("Änderungen verwerfen");
                    $('#modalBtn2').html("Änderungen speichern");
                    
                    //Change content from imput fields
                    $('#modalLabel').html($(this).children().eq(1).text());
                    $('#txtName').val($(this).children().eq(1).text());
                    $('#txtDescription').val($(this).children().eq(2).text());
                    
                    $('#modal-edit').modal('show');
                });
            });
        </script>
    </body>
</html>