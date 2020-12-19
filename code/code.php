<?php


if (!function_exists("getParamValue")) {


    function getParamValue($paramName, $fallback = "") {
        if (isset($_GET[$paramName]) && $_GET[$paramName] != '') {
            return $_GET[$paramName];
        } else {
            return $fallback;
        }
    }
}

if( !function_exists("postParamValue")) {
    function postParamValue($paramName, $fallback = "") {
        if (isset($_POST[$paramName]) && $_POST[$paramName] != '') {
            return addslashes($_POST[$paramName]);
        } else {
            return $fallback;
        }
    }
}

function checkCookieHash() {
    if (isset($_COOKIE['mlhash'])) {
        return password_verify(PASSWORD, $_COOKIE['mlhash']);
    }
    return false;
}

function performLogin($passwordInput) {
    $correctHash = password_hash(PASSWORD, PASSWORD_DEFAULT);

    if (!isset($_COOKIE["mlhash"])) {
        if (password_verify($passwordInput, $correctHash)) {
            setcookie("mlhash", $correctHash);
            return true;
        }
    }
    else
    {
        $cookieHash = $_COOKIE["mlhash"];
        return password_verify($passwordInput, $cookieHash);
    }
    return false;
}

if (!function_exists("saveRiskSelfAssessment")) {
    function saveRiskSelfAssessment($paraPostArray) {

    }
}

if (!function_exists("evaluateRiskTask")) {
    function evaluateRiskTask($paraProbability, $paraSuccessReward, $paraFailureReward) {
        $randomValue = rand(1, 100);

        if ($randomValue <= $paraProbability) {
            return $paraSuccessReward;
        }
        else {
            return $paraFailureReward;
        }
    }
}

if (!function_exists("formatCurrency")) {
    function formatCurrency($currency, $accuracy = 2, $delimiter = ".") {
        $string = number_format($currency, $accuracy, $delimiter, ",");

        return $string;
    }
}

if (!function_exists("isValidValue")) {
    function isValidValue($paraValue) {
        return $paraValue != null && $paraValue != "";
    }
}