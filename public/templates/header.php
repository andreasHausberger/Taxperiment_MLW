<?php require_once ($_SERVER['DOCUMENT_ROOT'] . "/code/code_ui.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Taxperiment - MLW</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/mlweb_public.css">

    <script src="/resources/library/jQuery/jquery-3.3.1.min.js"></script>
</head>

<body>
<?php
    if(!isset($showNav) || !$showNav) {
        echo "<div id=\"header\">
                <img src=\"/public/img/Uni_Logo_2016.png\" style=\"height: 125px\">
                <hr style=\"width: 100%;\">
            </div>
            <div class=\"pageContainer\">";
    }
    else {
        getNavBar();
        echo "<div class=\"pageContainer\">";
    }
?>
