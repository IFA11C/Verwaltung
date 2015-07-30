<?php
    include '../php/classes/db_connect.php';
    include('../php/classes/user.php');
    User::requiresRole("lehrer");
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
                            <div>
                                <h2>IT-Verwaltung</h2>
                                <p>Willkommen zum IT-Verwaltungssystem!</p>
                            </div>
                            <div>
                                <h3>Letzte Aktivitäten</h3>
                                <table class="table table-responsive">
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
    </body>
</html>