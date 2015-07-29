<?php
    include './php/classes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include('fragments/default_includes.php'); ?>
        <title>Räume</title>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(".raum").on( "click", function()
                {
                    var id = $(this).find(".hidden").text();
                    console.log("Id: " + id);
                });
            });
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <div class="row row-offcanvas row-offcanvas-left">              
                    <!-- Sidebar -->
                    <?php include('fragments/navigation_left.php'); ?>
                    <!-- /Sidebar -->
                    
                    <!-- main right col -->
                    <div class="column col-sm-10 col-xs-11" id="main">
                        <?php include('fragments/navigation_top.php'); ?>
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
                            
                            <form style="text-align: right;">
                                <button class="btn btn-success">Neu +</button>
                            </form>
                        </div>
                        
                        
                        
                        <div class="modal fade" id="modalAddRoom" tabindex="-1" role="dialog" aria-labelledby="modalAddRoom">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="meinModalLabel">neuen Raum hinzufügen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                                        <button type="button" class="btn btn-primary">Raum speichern</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
