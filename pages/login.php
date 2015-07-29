<?php
    include('../php/classes/user.php');
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        User::Login();
    }

    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET["code"]))
        {
            $code = $_GET["code"];
            switch($code) {
                case 403:
                    $message = "Sie haben nicht die nötigen Rechte um diese Aktion durchzuführen. Bitte melden Sie sich mit einem Nutzer an der die Entsprechenden Rechte hat.";
                    break;
                case 1337:
                    $message = "Fehler beim Anmelden. Bitte stellen Sie sicher das Ihr Benutzername und Passwort korrekt sind.";
                    break;
                case 41:
                    $message = "Erfolgreich abgemeldet.";
                    break;
            }
        }
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
                            <?php
                                if(isset($message))
                                {
                                    echo("
                                        <div class='center alert alert-danger' role='alert'>
                                            $message
                                        </div>
                                    ");    
                                }
                                
                            ?>
                            <div class="center col col-sm-4 col-sm-offset-4">
                                <h2>Login</h2>
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
    </body>
</html>