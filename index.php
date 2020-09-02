<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */
require_once('./resources/config.php');
require_once ("./code/code.php");

$password = postParamValue("password", "");

if ($password != "") {
    $isLoggedIn = performLogin($password);
}
else {
    $isLoggedIn = checkCookieHash();
}



require_once("public/templates/header.php");

if ($isLoggedIn) {
    include("start.php");
}
else
{
    include("login.php");
}

?>

<?php require_once("public/templates/footer.php"); ?>
