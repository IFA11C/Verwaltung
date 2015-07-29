<?php
    $homeUrl = "./index.php";
    $hardwareUrl = "./component.php";
    $propertiesUrl = "./componentsAttributes.php";
    $roomsUrl = "./rooms.php";
?>
<!-- Naviagtion -->
<div class="col col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
    <!-- Expaneded Navigation -->
    <ul class="nav hidden-xs" id="lg-menu">
        <li>
            <a href="<?php echo($homeUrl); ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Startseite</a>
        </li>
        <li>
            <a href="<?php echo($hardwareUrl); ?>"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Hardware</a>
        </li>
        <li>
            <a href="<?php echo($propertiesUrl); ?>"><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Eigenschaften</a>
        </li>
        <li>
            <a href="<?php echo($roomsUrl); ?>"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Räume</a>
        </li>
    </ul>
    <!-- /Expaneded Navigation -->

    <!-- Icon only Navigation -->
    <ul class="nav visible-xs" id="xs-menu">
        <li>
            <a href="<?php echo($homeUrl); ?>" class="text-center">
                <span class="glyphicon glyphicon-home"></span>
            </a>
        </li>
        <li>
            <a href="<?php echo($hardwareUrl); ?>" class="text-center">
                <span class="glyphicon glyphicon-list"></span>
            </a>
        </li>
        <li>
            <a href="<?php echo($propertiesUrl); ?>" class="text-center">
                <span class="glyphicon glyphicon-tag"></span>
            </a>
        </li>
        <li>
            <a href="<?php echo($roomsUrl); ?>" class="text-center">
                <span class="glyphicon glyphicon-book"></span>
            </a>
        </li>
    </ul>
    <div class="hidden-xs">
        <img id="sidebar-footer" src="images/Logo.png"/>
    </div>
    <!-- /Icon only Navigation -->
</div>
<!-- /Naviagtion -->
