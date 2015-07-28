<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
        <title>Schlüsselverwaltung</title>

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
                    </div>
                </div>
            </div>
        </div>
        
        <script src="js/jQuery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>