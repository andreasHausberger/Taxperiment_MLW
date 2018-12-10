<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 16:58
 */

$round = (isset($_GET['round']) ? $_GET['round'] : -1);
$mode = (isset($_GET['mode']) ? $_GET['mode'] : 0); //mode: 1 is for slider and 2 is for audit
$mostRecentScore = (isset($_POST['score']) ? $_POST['score'] : 0); // if we just had a slider round, there should be a most recent score posted

if ($round < 1 || $mode == 0) {
    echo "There is a problem.";
}
elseif ($round <= 18) {
    $pages = array(
        -1 => "error.html",
        1 => "slider.php",
        2 => "audit.php?score=" . $mostRecentScore,
    );

    $page = $pages[$mode];

    require_once("../../templates/header.php");
    include ($page);
    require_once("../../templates/footer.php");
}
else {
    // redirect to end of experiment
    echo "Something went wrong. sorry.";
}
