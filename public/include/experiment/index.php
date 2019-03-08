<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 16:58
 */

// echo "made it here";

$experimentID = -1;

if (isset($_GET['expid'])) {
    $experimentID = $_GET['expid'];
}
else {
    echo "No Experiment ID!";
    die();
}

require("../../../resources/config.php");
require("../../dataLoader.php");


parse_str($roundData, $expRounds);


global $expRounds, $dataArray;
$participant = $dataArray['pname'];
$participantID = isset($dataArray['pid']) ? $dataArray['pid'] : $_GET['pid'];
$condition = $dataArray['condition'];

if (isset($_POST['data']) && isset($_POST['roundData'])) {
    $data = $_POST['data'];
    $roundData = $_POST['roundData'];

    parse_str($roundData, $expRounds);
    parse_str($data, $dataArray);

    $participant = $dataArray['pname'];
    $condition = $dataArray['condition'];
    $experimentID = $_GET['expid'];
}


$round = (isset($_GET['round']) ? $_GET['round'] : -1);
$mode = (isset($_GET['mode']) ? $_GET['mode'] : 0); //mode: 1 is for slider and 2 is for audit

$mostRecentScore = -1; // if we just had a slider round, there should be a most recent score posted

// mostRecentScore should always include the 1000 basic income.
if (isset($_GET['score'])) {
    $mostRecentScore = $_GET['score'] + 1000;
}
elseif (isset ($_POST['score'])) {
    $mostRecentScore = $_POST['score'] + 1000;
}


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
        3 => "feedback.php",
    );

    $page = (string) $pages[$mode];

    require_once("../../templates/header.php");
    include ($page);
    require_once("../../templates/footer.php");
}
else {
    // redirect to end of experiment
    require_once("../../templates/header.php");
    include ("feedback.php");
    require_once("../../templates/footer.php");
}
