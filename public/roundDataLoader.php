<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 22.02.19
 * Time: 16:44
 */

$roundQuery = $connection->prepare("SELECT subject, round, income, reported_income, audit, honesty FROM mlweb WHERE experiment_id = $experimentID");


if ($roundQuery->execute()) {
    console_log("Executed round query!");
    if ($roundQuery->bind_result($subject, $round, $income, $reportedIncome, $audit, $honesty)) {
        while($roundQuery->fetch()) {
            echo "data found: $subject, $income, $reportedIncome";
        }
    }

}
else {
    echo "Error connecting: $connection->error";
}

if (!function_exists(buildResultsBlock)) {
    function buildResultsBlock($subject, $round, $income, $reportedIncome, $audit, $honesty) {
        $html = "";




        return $html;
    }
}
