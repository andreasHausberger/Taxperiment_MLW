<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 15:35
 */

include "../../../resources/config.php";

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

$participant = $_GET['pid'];

if (!isset($participant)) {
    echo "WARNING: COULD NOT READ PARTICIPANT!";
}

$randomRound = rand(1, 18);

if ($participant = 123) { $participant = 181; echo "<b> Test Mode! No meaningful data will be displayed here! </b>"; }
$selectString = "SELECT pid, round, net_income FROM audit WHERE pid = $participant and round = $randomRound";


$results = $connection->query($selectString);

$rows = $results->fetch_all();

$income = $rows[0][2];

$euros = round($income / 300, 2);



?>

<h1> Thank you for your participation!</h1>

<br>

<b> This is the last page. Thank you for your participation in this study.</b>

<br>
<p>
    Round <?php echo $randomRound ?> was randomly chosen.
    In this round, you earned a net income of <?php echo $income ?> ECU.
    This amounts to <?php echo $euros ?> Euro (300 ECU = 1 Euro).
    Together with the show-up fee of 1 Euro, your payment for participating in this study is <?php echo ($euros + 1) ?> Euro.
</p>
<br>
<p>
    Please tell the experimenter that you are finished and you will be paid the amount.
</p>

<b>
    DO NOT CLOSE THIS PAGE!
</b>
<p> If you close this page, you cannot be paid.</p>

