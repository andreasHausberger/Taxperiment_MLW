<?php

require_once ($_SERVER["DOCUMENT_ROOT"] . "/code/Database.php");
require_once ($_SERVER["DOCUMENT_ROOT"] . "/code/QueryBuilder.php");

if (sizeof($_POST) >= 1) {
    $db = new Database();

    $selfRisk = postParamValue("risk_self");
    $subjectName = postParamValue("subject");
    $page = postParamValue("page");

    if ($selfRisk && $selfRisk != "") {
        $insertID = $db->insertQuery("INSERT INTO risk_aversion (subject_name, self_risk) VALUES (?, ?)", "si", ...[$subjectName, $selfRisk]);

        if (!$insertID) {
            echo "Error!";
        } else {
            $nextPage = intval($page) + 1;

            $host = $_SERVER['HTTP_HOST'];
            $url = $host . '/public/include/intro/index.php?condition=' . $condition . '&sname=' . $subjectName . '&page=' . $nextPage;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);

            curl_exec($ch);

            curl_close($ch);        }
    }
}
?>