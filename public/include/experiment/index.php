<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 16:58
 */


$participant = (isset($_GET['sname']) ? $_GET['sname'] : "");
$condition = (isset($_GET['condition']) ? $_GET['condition'] : -1);

$round = (isset($_GET['round']) ? $_GET['round'] : -1);
$mode = (isset($_GET['mode']) ? $_GET['mode'] : 0); //mode: 1 is for slider and 2 is for audit
$mostRecentScore = (isset($_POST['score']) ? $_POST['score'] : 0); // if we just had a slider round, there should be a most recent score posted
 include('../../exp_config.php'); // defines variables


$round = (int) $round;
$mode = (int) $mode;
$mostRecentScore = (int) $mostRecentScore;

if ($round < 1 || $mode == 0) {
    echo "There is a problem.";
}
elseif ($round <= 18) {
    $pages = array(
        -1 => "error.html",
        1 => "slider.php",
        2 => "audit.php" ,
    );

    $page = (string) $pages[$mode];

    require_once("../../templates/header.php");
    include ($page);
    require_once("../../templates/footer.php");
}
else {
    // redirect to end of experiment
    echo "Something went wrong. sorry.";
}
