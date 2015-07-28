<?php
    include './php/classes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
        <title>IT-Verwaltung</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <div class="row row-offcanvas row-offcanvas-left">              
                    <!-- sidebar -->
                    <div class="col col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
                        <?php include('fragments/navigation.php'); ?>
                    </div>
                    
                    <!-- main right col -->
                    <div class="column col-sm-10 col-xs-11" id="main">
                        <div class="container">
                            <div>
                                <h2>IT-Verwaltung</h2>
                                <p>Willkommen zum IT-Verwaltungssystem!</p>
                            </div>
                            <div>
                                <h3>Letzte Aktivitäten</h3>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Objekt</th>
                                            <th>Aktion</th>
                                            <th>Datum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Hardware</td>
                                            <td>PC1</td>
                                            <td>CPU geändert auf: 2.4GHz</td>
                                            <td>02.07.2008 12:01</td>
                                        </tr>
                                        <tr>
                                            <td>Eigenschaften</td>
                                            <td>CPU</td>
                                            <td>Angelegt</td>
                                            <td>01.07.2008 15:43</td>
                                        </tr>
                                        <tr>
                                            <td>Hardware</td>
                                            <td>PC1</td>
                                            <td>Verschoben nach: r103</td>
                                            <td>01.07.2008 13:21</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="js/jQuery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>