<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:06
 */

//require_once ('code/code.php');

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
    define("DB_Name", "ml_external");
}

defined("LIBRARY_PATH") or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
defined("TEMPLATES_PATH") or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
defined("PASSWORD") or define("PASSWORD", "city-mouse-2659");

ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRICT);