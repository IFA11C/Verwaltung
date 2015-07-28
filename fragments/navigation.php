<?php
    $homeUrl = "/";
    $hardwareUrl = "#hardware";
    $propertiesUrl = "#eigenschaften";
    $roomsUrl = "#raume";
?>
<!-- Naviagtion -->
    <!-- This should expand the navigation if it is in Icon mode, but for some reason it doesn't.
    <ul class="nav">
        <li>
            <a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a>
        </li>
    </ul>
    -->

    <!-- Expaneded Navigation -->
    <ul class="nav hidden-xs" id="lg-menu">
        <li class="active">
            <a href="<?php echo($homeUrl); ?>"><span class="glyphicon glyphicon-home"></span> Startseite</a>
        </li>
        <li>
            <a href="<?php echo($hardwareUrl); ?>"><span class="glyphicon glyphicon-list"></span> Hardware</a>
        </li>
        <li>
            <a href="<?php echo($propertiesUrl); ?>"><span class="glyphicon glyphicon-tag"></span> Eigenschaften</a>
        </li>
        <li>
            <a href="<?php echo($roomsUrl); ?>"><span class="glyphicon glyphicon-book"></span> Räume</a>
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
    <!-- /Icon only Navigation -->
<!-- /Naviagtion -->
