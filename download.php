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


if (!isset($connection)) {
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
}

$sqlQuery = "select distinct expname from mlweb order by expname asc";

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
<div class='downloadButtonDiv'style='display: inline-flex;'>
  <form action='datalyser.php' method='post' style='margin: 0 10px;'>
    <input type='hidden' value= $row[0] name='exp_name'>
    <input type='hidden' value='true' name='unpack'>
    <input type='hidden' value='download' name='act'>
    <input type='submit' value='Download  raw .csv data for $row[0]'>
</form>

<form action='datalyser.php' method='post'>
    <input type='hidden' value= $row[0] name='exp_name'>
    <input type='hidden' value='true' name='unpack'>
    <input type='hidden' value='100' name='threshold'>
    <input type='hidden' value='1' name='divisions'>
    <input type='hidden' value='process' name='act'>
    <input type='submit' value='Download  processed .csv data for $row[0]'>
</form>

</div>
      

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


