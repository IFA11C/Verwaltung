<?php
    $homeUrl = "./index.php";
    $hardwareUrl = "./hardware.php";
    $propertiesUrl = "./hardwareItem.php";
    $roomsUrl = "./rooms.php";
?>

<!-- top nav -->
<div class="navbar navbar-static-top">  
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
        <!--
        <ul class="nav navbar-nav">
            <li>
                <a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
            </li>
            <li>
                <a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
            </li>
            <li>
                <a href="#"><span class="badge">badge</span></a>
            </li>
        </ul>
        -->
        <form class="navbar-form navbar-right">
            <div class="form-group">
                <input placeholder="Benutzername" class="form-control" type="text"/>
            </div>
            <div class="form-group">
                <input placeholder="Passwort" class="form-control" type="password"/>
            </div>
            <button type="submit" class="btn btn-success">Anmelden</button>
        </form>
        <!--
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="">More</a></li>
                    <li><a href="">More</a></li>
                    <li><a href="">More</a></li>
                    <li><a href="">More</a></li>
                    <li><a href="">More</a></li>
                </ul>
            </li>
        </ul>
        -->
    </nav>
</div>
<!-- /top nav -->