<?php

function getParamValue($paramName, $fallback = "") {
    if (isset($_GET[$paramName]) && $_GET[$paramName] != '') {
        return $_GET[$paramName];
    }
    else {
        return $fallback;
    }
}

function postParamValue($paramName, $fallback = "") {
    if (isset($_POST[$paramName]) && $_POST[$paramName] != '') {
        return $_POST[$paramName];
    }
    else {
        return $fallback;
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
    else {
        $cookieHash = $_COOKIE["mlhash"];
        return password_verify($passwordInput, $cookieHash);
    }
    return false;
}