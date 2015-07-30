<?php
    include('../php/dbq/attribute_query.php');
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
                            <h1 class="page-header">Komponenten Eigenschaften</h1>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $properties = getAttributes();
                                        foreach($properties as $property) {
                                            $id = $property["kat_id"];
                                            $name = $property["kat_bezeichnung"];
                                            echo('
                                                <tr>
                                                    <td class="clickable">'.$id.'</td>
                                                    <td class="clickable">'.$name.'</td>
                                                    <td class="delete-column">
                                                        <button name="btnRemove" class="delete-button pull-right"><span class="glyphicon glyphicon-remove-sign"></span>
                                                    </td>
                                                </tr>
                                            ');    
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <form class="pull-right">
                                <button class="btn btn-info" type="button" onclick="AddHardwareProperty();">Neu</button>
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
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
<!--                        <input id="modal-hardware-property-action" name="action" type="hidden" value=""/>-->
                        <input id="modal-hardware-property-id" name="kat_id" type="hidden" value=""/>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label" for="txtName">Name</label>
                                <input name="kat_bezeichnung" placeholder="Name" id="txtName" class="form-control" type="text"/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="modal-hardware-property-btn-1" type="button" class="btn btn-warning" data-dismiss="modal"></button>
                            <button id="modal-hardware-property-btn-2" type="submit" class="btn btn-success"></button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            function AddHardwareProperty() {
                $('#modal-hardware-property-label').html("Eigenschaft hinzufügen");
                
                //Change button text
                $('#modal-hardware-property-btn-1').html("Abbrechen");
                $('#modal-hardware-property-btn-2').html("Eigenschaft hinzufügen");
                
                //Clear values
                $('#modal-hardware-property').find('input').each( function () {
                    $(this).val('');
                });
                $('#modal-hardware-property-action').val(0);
                
                $('#modal-hardware-property-btn-2').attr('name', 'btnInsert');
                
                $('#modal-hardware-property').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr .clickable').on('click', function(){
                    $('#modal-hardware-property-label').html("Hardware bearbeiten");
                    
                    //Change button text
                    $('#modal-hardware-property-btn-1').html("Änderungen verwerfen");
                    $('#modal-hardware-property-btn-2').html("Änderungen speichern");
                    
                    //Change content from input fields
                    $('#modal-hardware-property-id').val($(this).parent().children().eq(0).text());
                    $('#txtName').val($(this).parent().children().eq(1).text());
                    
                    $('#modal-hardware-property-action').val(1);
                    
                    $('#modal-hardware-property-btn-2').attr('name', 'btnUpdate');
                
                    $('#modal-hardware-property').modal('show');
                });
                
                $('table tr .delete-column').on('click', function(){
                    var id = $(this).parent().children().eq(0).text();
                    postDelete(id);
                });
            });
            
            function postDelete(id) {
                // The rest of this code assumes you are not using a library.
                // It can be made less wordy if you use one.
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "<?php echo($_SERVER["PHP_SELF"]); ?>");
                
                var idField = addHiddenField("kat_id", id);
                var btnRemove = addHiddenField("btnRemove", 1);
                form.appendChild(btnRemove);
                form.appendChild(idField);
                
                document.body.appendChild(form);
                form.submit();
            }
            
            function addHiddenButton(name) {
                var button = document.createElement("button");
                button.setAttribute("type", "hidden");
                button.setAttribute("name", name);
                button.click();
                return button;
            }
            
            function addHiddenField(name, value) {
                var field = document.createElement("input");
                field.setAttribute("type", "hidden");
                field.setAttribute("name", name);
                field.setAttribute("value", value);
                
                return field;
            }
        </script>
    </body>
</html>