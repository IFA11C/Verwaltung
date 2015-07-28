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
                            <h1 class="headline">PC 0056 <a class="btn btn-info pull-right">Bearbeiten</a></h1>

                            <div class="hardware-info">
                                <h3>Asus 7594</h3>
                                <h3>Seriennummer 012654</h3>
                                <h3>Raum 45.110</h3>
                            </div>

                            <h3>Eigenschaften </h3>  
                            <ul class="list-group">
                              <li class="list-group-item">Cras justo odio</li>
                              <li class="list-group-item">Dapibus ac facilisis in</li>
                              <li class="list-group-item">Morbi leo risus</li>
                              <li class="list-group-item">Porta ac consectetur ac</li>
                              <li class="list-group-item">Vestibulum at eros</li>
                              <li class="list-unstyled"><a class="btn btn-info pull-right">Add</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>