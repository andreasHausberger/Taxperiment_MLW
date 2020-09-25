<?php
// 		save.php: saves MouselabWEB data in database
//
//       v 1.00betav2 , 14 Aug 2008    
//		updated version v2 using real_escape_string functions to escape quotes 
//		before loading into the database
//
//     (c) 2003-2008 Martijn C. Willemsen and Eric J. Johnson 
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

// include('mlwebdb.inc.php');
include ($_SERVER["DOCUMENT_ROOT"] ."/resources/config.php");
include ($_SERVER["DOCUMENT_ROOT"] ."/resources/code/code.php");

if (!isset($id)) {
    $id = -1;
}


if (isset($_POST)) {
    $expname = $_POST['expname'];
    $subject = intval($_POST['subjectID']);
    $condnum =$_POST['condition'];
    $choice = $_POST['choice'];
    $procdata = $_POST['procdata'];

    $actualIncome = $_POST['actual_income'];
    $netIncome = $_POST['net_income'];
    $actualTax = $_POST['tax'];
    $reportedTax = $_POST['reported_tax'];
    $audit = $_POST['wasAudited'];
    $honesty = $_POST['wasHonest'];
    $currentRound = intval($_POST['round']);
    $fine = intval($_POST['fine']);
    $nextURL = $_POST['nextURL'];
    $addvar = "null";
    $adddata = "null";
    $expID = intval($_POST['experimentID']);
    console_log("Process Data saved successfully!");
}
else {
    echo "Error saving datas: No data was found";
    die();
}
$count = 0;



//foreach ($_POST as $key => $value) {
//    echo $count;
//     switch ($key) {
//			case "expname":
//				$expname = $value;
//				break;
//			case "subject":
//				$subject = $value;
//				break;
//			case "condnum":
//				$condnum= $value;
//				break;
//			case "choice":
//				$choice= $value;
//				break;
//			case "procdata":
//				$procdata= mysql_real_escape_string($value);
//				break;
//			case "nextURL":
//				$nextURL= $value;
//				break;
//			case "to_email":
//				// ignore emailaddress
//				break;
//			default:
//			$addvar .= mysql_real_escape_string($key).";";
//			$adddata .= "\"".mysql_real_escape_string($value)."\";" ;
//			}
//        $count = $count + 1;
//    }

    // var_dump($procdata);

$ipstr = $_SERVER['REMOTE_ADDR'];

$table = 'mlweb';

$honesty = $_POST['wasHonest'] == "true" ? 1 : 0;
$audited = $_POST['wasAudited'] == "true" ? 1 : 0;

$sqlquery = "INSERT INTO $table (expname, subject, ip, condnum, choice, submitted, round, procdata, addvar, adddata) VALUES ('$expname','$subject','$ipstr', $condnum,'$choice', NOW(), $currentRound, '$procdata', '$addvar', '$adddata' )";
if (isset($connection)) {
    if ($connection->query($sqlquery)) {
        echo( "Inserted data successfully - " . $connection->info);
    }
    else {
        echo("Error inserting data - " . $connection->error);
    }
}



$auditQuery = "INSERT INTO audit (exp_id, pid, round, actual_income, net_income, actual_tax, declared_tax, honesty, audit, fine) VALUES ($expID, $subject, $currentRound, $actualIncome, $netIncome,  $actualTax, $reportedTax, $honesty, $audited, $fine)";
if (isset($connection)) {
    if ($connection->query($auditQuery)) {
        echo ("Inserted audit data successfully for ExpID $expID and round $currentRound");
    }
    else {
        echo "there was a problem inserting audit data" . $connection->error;
    }
}
//$result = mysql_query($sqlquery);
//mysql_close();

/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$nextRound = $currentRound + 1;
$feedback = $_GET['feedback'];
$order = $_GET['order'];
$presentation = $_GET['presentation'];



header("Location: http://$host/public/include/experiment/index.php?round=$nextRound&condition=$condnum&mode=1&expid=$expID&pid=$subject&feedback=$feedback&order=$order&presentation=$presentation");
//exit;
?>
