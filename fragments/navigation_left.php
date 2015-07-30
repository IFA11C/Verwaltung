<?php
    $homeUrl = "./index.php";
    $componentUrl = "./component.php";
    $propertiesUrl = "./componentAttributes.php";
    $softwareUrl = "./software.php";
    $roomsUrl = "./rooms.php";
    $logoutUrl = "./logout.php";
?>
<!-- Naviagtion -->
<div class="col col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
    <!-- Expaneded Navigation -->
    <ul class="nav hidden-xs" id="lg-menu">
        <li>
            <a href="<?php echo($homeUrl); ?>"><span class="glyphicon glyphicon-home"></span><span class="navigationText">Startseite</span></a>
        </li>
        <li>
            <a href="<?php echo($componentUrl); ?>"><span class="glyphicon glyphicon-list"></span><span class="navigationText">Komponenten</span></a>
        </li>
        <li>
            <a href="<?php echo($softwareUrl); ?>"><span class="glyphicon glyphicon-th-large"></span>&nbsp;&nbsp;Software</a>
        </li>
        <li>
            <a href="<?php echo($propertiesUrl); ?>"><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Eigenschaften</a>
        </li>
        <li>
            <a href="<?php echo($roomsUrl); ?>"><span class="glyphicon glyphicon-book"></span><span class="navigationText">Räume</span></a>
        </li>
        <li>
            <span>&nbsp;</span>
        </li>
        <li>
            <a href="<?php echo($logoutUrl); ?>"><span class="glyphicon glyphicon-eject"></span><span class="navigationText">Abmelden</span></a>
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
            <a href="<?php echo($componentUrl); ?>" class="text-center">
                <span class="glyphicon glyphicon-list"></span>
            </a>
        </li>
        <li>
            <a href="<?php echo($softwareUrl); ?>" class="text-center">
                <span class="glyphicon glyphicon-th-large"></span>
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
        <li>
            <a href="<?php echo($userUrl); ?>" class="text-center">
                <span class="glyphicon glyphicon-eject"></span>
            </a>
        </li>
    </ul>
    <div class="hidden-xs">
        <img id="sidebar-footer" src="../images/Logo.png"/>
    </div>
    <!-- /Icon only Navigation -->
</div>