<?php require_once ("head.php"); ?>
<body>
<?php
    if(!isset($showNav) || !$showNav) {
        echo "<div id=\"header\">
                <img src=\"/public/img/Uni_Logo_2016.png\" style=\"height: 125px\">
                <hr style=\"width: 100%;\">
            </div>
            <div class=\"pageContainer\">";
    }
    else {
        getNavBar();
        echo "<div class=\"pageContainer\">";
    }
?>
