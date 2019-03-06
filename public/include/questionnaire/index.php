<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 09:28
 */

$index = isset($_GET['page']) ? $_GET['page'] : -1;
$participant = isset($_GET['sname']) ? $_GET['sname'] : "";

$participant = 123;


$pages = array(
    -1 => "error.html",
    1 => "memAttn.php",
    2 => "aboutExp.php",
    3 => "numeracy.php"
);

$page = $pages[$index];
if (!function_exists("createLikert")) {
    function createLikert($number, $name)
    {
        $html = "";

        $count = 1;
        while ($count <= $number) {
            $html = $html . " <div class=\"radioItemFlex\">
                    <input type=\"radio\" name=\"$name\" value=\"$count\">
                    <p> $count </p>
                   </div>";

            $count++;
        }

        return $html;
    }
}

if ($condition == -1) {
    echo "Something went wrong: Index is " . $index . " and condition is " . $condition;
}
else {

    require_once("../../templates/header.php");

    include($page);


    require_once("../../templates/footer.php");


}


?>