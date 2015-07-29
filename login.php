<?php
include_once 'php/classes/login.php';
sec_session_start();
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
    </head>
    <body>
        <div class="container">
            <div class="card card-signin">
                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="text-danger text-center">Sie haben versucht, sich mit einer falschen Username oder einem falschen Kennwort anzumelden.</p>';
                }
                ?> 
                <form class="form-signin " action="includes/process_login.php" method="post" name="login_form">
                    <input type="text" class="form-control" name="name">
                    <input type="password" class="form-control" name="password">
                    <input class="btn btn-lg btn-primary btn-block" type="button" value="Anmelden" onclick="formhash(this.form, this.form.password);" />
                </form>
            </div>
        </div>
        <script src="js/bootstrap.js"></script>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </body>
</html>