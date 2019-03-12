<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 11:27
 */

include "../../../resources/config.php";

$herokuURL = getenv('HEROKU_URL');

if (sizeof($_POST) >= 3) {

    $ma1 = $_POST["ma1"];
    $ma2 = $_POST["ma2"];
    $ma3 = $_POST["ma3"];

    $participant = $_GET['pid'];


    $insertQuery = "INSERT INTO questionnaire (pid, ma1, ma2, ma3, created) VALUES ($participant, $ma1, $ma2, $ma3, NOW())";
    if (isset($connection)) {
        if ($connection->query($insertQuery)) {
            echo("MA inserted successfully!");

            $herokuURL = getenv('HEROKU_URL');

            if (isset($herokuURL)) {
                $host = $herokuURL;
            }
            else {
                $host  = $_SERVER['HTTP_HOST'];
            }

            $urlString = "https://$host/public/include/questionnaire/index.php?pid=$participant&page=2";
            var_dump($urlString);
            
            header("Location: $urlString");
        }
        else {
            echo "Problem! " . $connection->error();
        }
    }
    else {
        echo "Could not connect to database!";
    }
}
else {
    echo "Please fill out every question on the page!";
}
?>

<h1> Memory / Attention Check </h1>
<form method="post">
    <div class="item">
        <div class="radioDisplayVertical">
            <p> 1. What were the tax rates in the tax game?</p>
            <div class="radioItemFlex">
                <input type="radio" name="ma1" value="0">
                <p> 20% and 40%</p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma1" value="1">
                <p> 20% and 30% </p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma1" value="2">
                <p> 10% and 20%</p>
            </div>

        </div>
    </div>

    <div class="item">
        <div class="radioDisplayVertical">
            <p> 2. What were the audit probabilities in the tax game?</p>
            <div class="radioItemFlex">
                <input type="radio" name="ma2" value="0">
                <p> 20% and 30%</p>
            </div>


            <div class="radioItemFlex">
                <input type="radio" name="ma2" value="1">
                <p> 10% and 20% </p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma2" value="2">
                <p> 10% and 30%</p>
            </div>

        </div>
    </div>

    <div class="item">
        <div class="radioDisplayVertical">
            <p> 3. What were the fine levels in the tax game?</p>
            <div class="radioItemFlex">
                <input type="radio" name="ma3" value="0">
                <p> 1, 2, or 3 times the evaded amount</p>
            </div>


            <div class="radioItemFlex">
                <input type="radio" name="ma3" value="1">
                <p> 2, 3, or 4 times the evaded amount </p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma3" value="2">
                <p> 2, 4, or 6 times the evaded amount</p>
            </div>

        </div>
    </div>

    <input type="submit" value="Next Page">

</form>
