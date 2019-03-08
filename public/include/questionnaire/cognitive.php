<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:16
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 1) {
    $cog1 = $_POST["cog1"];

    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET cog1 = $cog1 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            echo("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?pid=$participant&page=5");
        }
        else {
            echo "Problem: " . $connection->error();
        }
    }
}
else {
    echo "Please fill out every question on the page!";
}

?>

<h1>Cognitive Effort</h1>

<form method="post">
    <div class="item">
        <p class="questionText"> 1. I feel relief rather than satisfaction after completing a task that required a lot of mental effort (1 = extremely uncharacteristic; 7 = extremely characertistic)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "cog1"); ?>

        </div>
    </div>

    <input type="submit" value="Next Page">

</form>
