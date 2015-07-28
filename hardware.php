<?php
    include './php/classes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include('fragments/default_includes.php'); ?>
        <title>IT-Verwaltung</title>
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
                            
                            <h1 class="page-header">
                                Hardwareverwaltung
                            </h1>
                            
                            <table class="table table-responsive">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Raum</th>
                                      <th>Lieferant</th>
                                      <th>Einkaufsdatum</th>
                                      <th>Garantie in Jahren</th>
                                      <th>Beschreibung</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td>PC 004</td>
                                      <td>102.110</td>
                                      <td>Amazon</td>
                                      <td>20.05.15</td>
                                      <td>2</td>
                                      <td>PC für Sekretärin</td>
                                  </tr>
                                  <tr>
                                      <td>2</td>
                                      <td>PC 004</td>
                                      <td>102.110</td>
                                      <td>Amazon</td>
                                      <td>20.05.15</td>
                                      <td>2</td>
                                      <td>PC für Sekretärin</td>
                                  </tr>
                                  <tr>
                                      <td>3</td>
                                      <td>PC 004</td>
                                      <td>102.110</td>
                                      <td>Amazon</td>
                                      <td>20.05.15</td>
                                      <td>2</td>
                                      <td>PC für Sekretärin</td>
                                  </tr>
                                  <tr>
                                      <td>4</td>
                                      <td>PC 004</td>
                                      <td>102.110</td>
                                      <td>Amazon</td>
                                      <td>20.05.15</td>
                                      <td>2</td>
                                      <td>PC für Sekretärin</td>
                                  </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>