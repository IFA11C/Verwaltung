<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (!$error) {
    $error = 'Oops! An unknown error happened.';
}
?>
<html>
    <head>
        <title>Error</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <div class="arrow">
                <h1>Entschuldigung :(</h1>
                <p><?php echo $error; ?></p>
                <p><small>Das ist alles was wir wissen.</small></p>
            </div>
        </div>
        <script src="js/bootstrap.js"></script>
    </body>
</html>