<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 03.01.19
 * Time: 15:26
 */

/*
 * This should be called every time experiment/index.php is called, to re-fetch the round data.
 * Thus, the actuality of data is ensured.
 *
 * THIS FILE DOES NOT SAVE ANYTHING.
 */

require_once ($_SERVER['DOCUMENT_ROOT'] . "/code/Database.php");

$db = new Database();

$conditionQuery = "SELECT * FROM exp_condition AS c WHERE c.id = (?)";
$conditionData = $db->selectQuery($conditionQuery, 's', $_GET['condition']);


$experimentQuery = "SELECT * FROM experiment WHERE id = (?)";
$experimentData = $db->selectQuery($experimentQuery, 'i', $experimentID);

global $expRounds, $dataArray;

$roundQueryAsc = "SELECT * FROM exp_round";

global $expRounds, $dataArray;
$expRounds = $db->selectQuery($roundQueryAsc);

//$test = getRandomOrder($connection, $experimentID);
//
//$roundOrder = getRandomOrder($connection, $experimentID)["roundArray"];
//$conditionOrder = getRandomOrder($connection, $experimentID)["conditionArray"];

$roundNr = 1;
$dataArray = array(
    "test" => "test",
    "pname" => null,
    "pid" => $participantID,
    "expID" => $experimentID,
    "condition" => $conditionData[0],
    "feedback" => $conditionData[2],
    "order" => $conditionData[1],
    "presentation" => $conditionData[3],
    "roundOrder" => null,
    "conditionOrder" => null,
    "conditionData" => null
);


$data = http_build_query(array('data' => $dataArray));
$roundData = http_build_query(array('data' => $expRounds));