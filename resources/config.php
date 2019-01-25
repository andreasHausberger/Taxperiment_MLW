<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:06
 */

function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

// echo "made it to config";

$config = array(
    "db" => array(
        "db1" => array(
            "servername" => "localhost",
            "username" => "root",
            "password" => "root",
            "dbname" => "mlweb"
        ),
        "db2" => array(
            "dbname" => "mouselabWEB",
            "username" => "root",
            "password" => "root",
            "host" => "mlweb"
        )
    ),
    "urls" => array(
        "baseUrl" => "http://mouselabweb:8888"
    ),
    "paths" => array(
        "resources" => "public/templates/",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/public/img",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/public/css"
        )
    )
);


if (getenv("CLEARDB_DATABASE_URL") != null) {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $connection = new mysqli($server, $username, $password, $db);
} else {
    $connection = new mysqli("localhost",
        "root",
        "root",
        "mlweb");
}


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    console_log("Connected successfully");
}

defined("LIBRARY_PATH") or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
defined("TEMPLATES_PATH") or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRCT);

require(LIBRARY_PATH . '/mlwebphp_100beta/create_table.php');
