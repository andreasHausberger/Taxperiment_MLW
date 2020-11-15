<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once( $root . "/resources/config.php");
require_once($root . "/code/code.php");

$page = getParamValue("page");
$action = getParamValue("action");

$showNav = true;

if($page != "") {
    include($root . "/public/templates/header.php");
    switch ($page) {
        case "download":
            include($root . "/download.php");
            break;
        case "designer":
            include($root . "/resources/library/designer_100beta/index.html");
            break;
    }
    include($root . "/public/templates/footer.php");

}