<?php
    include '../php/dbq/software_query.php';
    include '../php/dbq/rooms_query.php';
    include '../php/dbq/componentType_query.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include('../fragments/default_includes.php'); ?>
        <script src="../js/jsform.js"></script>
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
                            <h1 class="page-header">Software</h1>
                            <table class="table table-responsive">
                              <thead>
                                  <tr>
                                      <th>Type</th>
                                      <th>Raum</th>
                                      <th>Einkaufsdatum</th>
                                      <th>Garantie in Jahren</th>
                                      <th>Hersteller</th>
                                      <th>Beschreibung</th>
                                      <th>&nbsp;</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                    $softwares = getAllSoftware();

                                    foreach ($softwares as $software) {
                                        echo(
                                            "<tr class='component'>
                                                <td class='hidden'>".$software['k_id']."</td>
                                                <td class='clickable'>".$software['komponentenart_ka_id']."</td>
                                                <td class='clickable'>".$software["raeume_r_id"]."</td>
                                                <td class='clickable'>".$software["k_einkaufsdatum"]."</td>
                                                <td class='clickable'>".$software["k_gewaehrleistungsdauer"]."</td>
                                                <td class='clickable'>".$software["k_hersteller"]."</td>
                                                <td class='clickable'>".$software["k_notiz"]."</td>
                                                <td class='delete-column'>
                                                    <button name='btnRemoveSoftware' class='delete-button pull-right'><span class='glyphicon glyphicon-remove-sign'></span>
                                                </td>
                                            </tr>"
                                        );
                                    }
                                ?>
                              </tbody>
                            </table>
                            <form class="pull-right">
                                <button class="btn btn-info" type="button" onclick="AddSoftware();">Neu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-software" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                        <h4 id="modal-software-label" class="modal-title"></h4>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                        <input id="k_id" name="k_id" type="hidden" value=""/>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Type</label>
                                <select id="componentType_id" name="komponentenart_ka_id" class="form-control">
                                <?php
                                    $types = getComponentTypes();
                                    foreach($types as $type) {
                                        $typeId = $type["Id"];
                                        $componentType = $type["ComponentType"];
                                        echo("<option value='$typeId'>$componentType</option>");
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Raum</label>
                                <select id="room_id" name="raeume_r_id" class='form-control'>
                                <?php 
                                    $rooms = getRooms();
                                    foreach($rooms as $room) {
                                        $roomId = $room["Id"];
                                        $roomNumber = $room["Number"];
                                        $roomName = $room["Description"];
                                        echo("<option value='$roomId'>$roomNumber - $roomName</option>");
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Einkaufsdatum</label>
                                <div class="input-group">
                                    <input id="datepicker" placeholder="Einkaufsdatum" class="form-control" type="text" name="k_einkaufsdatum"/>
                                    <span class="input-group-addon glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Garantie in Jahren</label>
                                <input id="warranty" placeholder="Garantie" class="form-control" type="number" name="k_gewaehrleistungsdauer"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hersteller</label>
                                <input id="manufacturer" placeholder="Hersteller" class="form-control" type="text" name="k_hersteller"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Beschreibung</label>
                                <input id="description" placeholder="Beschreibung" class="form-control" type="text" name="k_notiz"/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="modal-software-btn-1" type="button" class="btn btn-warning" data-dismiss="modal"></button>
                            <button id="modal-software-btn-2" type="submit" class="btn btn-success"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            function AddSoftware() {
                $('#modal-software-label').html("Software hinzufügen");
                
                //Change button text
                $('#modal-software-btn-1').html("Abbrechen");
                $('#modal-software-btn-2').html("Software hinzufügen");
                
                //Clear values
                $('#modal-software').find('input').each(function () {
                    $(this).val('');
                });
                
                $('#modal-software-btn-2').attr('name', 'btnInsertSoftware');
                
                $('#modal-software').modal('show');
            };
            
            $(document).ready(function(){
                $('table tr .clickable').on('click', function() {
                    $('#modal-software-label').html("Software bearbeiten");
                    
                    //Change button text
                    $('#modal-software-btn-1').html("Änderungen verwerfen");
                    $('#modal-software-btn-2').html("Änderungen speichern");
                    
                    //Clear values
                    $('#modal-software').find('input').each( function () {
                        $(this).parent().val('');
                    });
                    
                    //Change content from input fields
                    $('#k_id').val($(this).parent().children().eq(0).text());
                    
                    var componentName = $(this).parent().children().eq(1).text();
                    var selectComponentTypes = document.getElementById('componentType_id');
                    setCorrespondingIndex(selectComponentTypes, componentName);
  
                    var room = $(this).parent().children().eq(2).text();
                    var selectRoom = document.getElementById('room_id');
                    setCorrespondingIndex(selectRoom, room);
                    
                    $('#datepicker').val($(this).parent().children().eq(3).text());
                    $('#warranty').val($(this).parent().children().eq(4).text());
                    $('#manufacturer').val($(this).parent().children().eq(5).text());
                    $('#description').val($(this).parent().children().eq(6).text());
                    
                    $('#modal-software-btn-2').attr('name', 'btnUpdateSoftware');
                
                    //Show Modal
                    $('#modal-software').modal('show');
                });
                
                $('table tr .delete-column').on('click', function(){
                    var id = $(this).parent().children().eq(0).text();
                    console.log(id);
                    postDelete(id);
                });
                
                /*
                 * Erstellt einen auf deutsch Localisierten DatePicker
                 * für das Einkaufsdatum an.
                 */
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    monthNames: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
                    dayNames: ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"],
                    dayNamesShort: ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"],
                    dayNamesMin: ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"],
                });
            });
            
            function setCorrespondingIndex(select, value) {
                for(var i = 0, j = select.options.length; i < j; i++) {
                    if(select.options[i].innerHTML.indexOf(value) > -1) {
                       select.selectedIndex = i;
                       break;
                    }
                }
            }
            
            function postDelete(id) {
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "<?php echo($_SERVER["PHP_SELF"]); ?>");
                
                var idField = addHiddenField("k_id", id);
                var btnRemove = addHiddenField("btnRemoveSoftware", 1);
                form.appendChild(btnRemove);
                form.appendChild(idField);
                
                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </body>
</html>