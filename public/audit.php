<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 07.12.18
 * Time: 12:25
 */

$totalScore = $_POST['score'];
$data;
parse_str($_GET['data'], $data);

echo "Got Score: " . $totalScore;

echo " and got presentation " . $data['presentation'];
?>