<?php
    include '../php/classes/db_connect.php';
    include '../php/classes/user.php';
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        User::Login();
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include('../fragments/default_includes.php'); ?>
        <title>Login</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <div class="row row-offcanvas row-offcanvas-left">              
                    <!-- main right col -->
                    <div class="column col-sm-12 col-xs-12" id="main">
                        <div class="container">
                            <div class="col col-sm-4 col-sm-offset-4">
                                <h2 class="page-header">Login</h2>
                            </div>
                            <div class="col col-sm-4 col-sm-offset-4">
                                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                    <div class="form-group">
                                        <input name="username" placeholder="Benutzername" class="form-control" type="text"/>
                                    </div>
                                    <div class="form-group">
                                        <input name="password" placeholder="Passwort" class="form-control" type="password"/>
                                    </div>
                                    <button type="submit" class="btn btn-success form-control">Anmelden</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav navbar-fixed-bottom">
            <div class="pull-right hidden-xs">
                <img src="../images/Logo.png"/>
            </div>
        </nav>
    </body>
</html>