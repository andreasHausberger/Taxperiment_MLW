<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 01.03.19
 * Time: 12:13
 */

require_once('./resources/config.php');

require_once ("public/templates/header.php");

echo "<h1>Downloads </h1>";

echo "<br>";


if (getenv("CLEARDB_DATABASE_URL") != null) {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $connection = new mysqli($server, $username, $password, $db);
} else {
    $connection = new mysqli("localhost",
        "root",
        "root",
        "mlweb");
}

$sqlQuery = "select distinct expname from mlweb";

$result = $connection->query($sqlQuery);

if ($result->num_rows == 0) {
    echo "No Records found";
}
else {

    echo "<h2> Download of Proc Data (Mouselab Table data)</h2>";

    $rows = $result->fetch_all();
    $index = 0;
    foreach ($rows as $row) {
        echo ("
        <form action=\"datalyser.php\" method=\"post\">
    <input type=\"hidden\" value=\"mlweb\" name=\"pwd\">
    <input type=\"hidden\" value= $row[0] name=\"exp_name\">
    <input type=\"hidden\" value=\"true\" name=\"unpack\">
    <input type=\"hidden\" value=\"download\" name=\"act\">
    <input type=\"submit\" value=\"Download .csv data for $row[0]\">
</form>
        "
        );

    }
}
?>

<?php

echo "<h2> Download of Questionnaire data and Audit Data </h2>";

include "./resources/dataDownloader.php";

?>




<?php

require_once ("public/templates/footer.php")

?>


