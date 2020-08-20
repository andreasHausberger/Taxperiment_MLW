<?php

function getParamValue($paramName, $fallback = "") {
    if (isset($_GET[$paramName]) && $_GET[$paramName] != '') {
        return $_GET[$paramName];
    }
    else {
        return $fallback;
    }
}