<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:06
 */

require_once ('code/code.php');



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


/**
 * HEROKU SETUP
 * This is used for Heruku Setup with a ClearDB database.
 */
if (getenv("CLEARDB_DATABASE_URL") != null) {

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    define("DB_Host", $url["host"]);
    define("DB_User", $url["user"]);
    define("DB_Password", $url["pass"]);
    define("DB_Name", substr($url["path"], 1));
}
else {
    /**
     * Enter database credentials here!
     * First value: Constant var name (DO NOT CHANGE)
     * Second value: Defined value (CHANGE THIS).
     */
    define("DB_Host", "localhost");
    define("DB_User","root");
    define("DB_Password", "root");
    define("DB_Name", "mlnew");
}


if (!isset($connection)) {
        $connection = new mysqli(DB_Host,
            DB_User,
            DB_Password,
            DB_Name);
}

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    console_log("Connected successfully");
}

$globalExpRounds = loadRoundData($connection);


if (!$_COOKIE['GLOBAL_ROUNDS']) {
    setcookie('GLOBAL_ROUNDS', json_encode($globalExpRounds));
}

defined("LIBRARY_PATH") or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
defined("TEMPLATES_PATH") or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRICT);

require(LIBRARY_PATH . '/mlwebphp_100beta/create_table.php');
