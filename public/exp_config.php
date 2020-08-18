<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 05.12.18
 * Time: 10:38
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/config.php');

// include ("./templates/header.php");

$prolificPID = "";
$studyID = "";
$sessionID = "";
$userAgent = "";

$prolificPID = isset($_GET['prolificPID']) ? $_GET['prolificPID'] : "" ;
$studyID = isset($_GET['studyID']) ? $_GET['studyID'] : "";
$sessionID = isset($_GET['sessionID']) ? $_GET['sessionID'] : "";
$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
if (!isset($connection)) {
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
    echo "Reestablished connection";
}


$participantQuery = $connection->prepare("INSERT INTO participant (name) VALUES (?)");

$participantQuery->bind_param("s", $_GET['sname']);

$participantID = -1;
$experimentID = -1;

if ($participantQuery->execute()) {
    $participantID = $connection->insert_id;
    console_log(" Participant with id " . $participantID . " saved successfully");
} else {
    echo "Error saving participant: " . $connection->error;
    var_dump($participantQuery);
}

$experimentQuery = $connection->prepare("INSERT INTO experiment (exp_condition, participant, prolific_pid, study_id, session_id, device_type) VALUES (?, ?, ?, ?, ?, ?)");

$experimentQuery->bind_param("iissss", $condition, $participantID, strval($prolificPID), strval($studyID), strval($sessionID), strval($userAgent));

if ($experimentQuery->execute()) {
    $experimentID = $connection->insert_id;

    console_log(" Experiment data with ID " . $experimentID . " saved successfully! \n");
} else {
    echo "Error saving experiment data: " . $connection->error . "\n";
}

$dateQuery = $connection->prepare("UPDATE experiment SET start = NOW() WHERE id = ?");
$dateQuery->bind_param("i", $experimentID);

if ($dateQuery->execute()) {
    console_log("Added start date for Experiment $experimentID");
} else {
    echo "Error setting start date for experiment $experimentID: $connection->error";
}

include("dataLoader.php");

$condition = $dataArray['condition'];
//CKogler-Branch: Always immediate feedback, always in order.
$feedback = 0; //$dataArray['feedback'];
$order = 0; // $dataArray['order'];
$presentation = $dataArray['presentation'];


include("./templates/header.php");
switch ($tutorial) {
    case 0:
        break;
    case 1:
        echo "
                <p>
                    Before you start making decisions about paying taxes in this study, we would like to give you an idea 
                    about the tax norms in the UK. People may have different ideas about other citizens’ tax morals. Some 
                    might underestimate, whereas some might overestimate the number of citizens who believe people should
                    be honest when reporting their taxes. To make sure that every participant in this study has access to
                    this information before they make their tax decisions, we present you with an overview of how other 
                    UK citizens think about tax compliance:
                 </p>
                 <p>
                     The World Values Survey is one of the most credible worldwide surveys, and it has been carried out 
                     since 1981. These surveys are nationally representative and reach out to almost 400,000 participants 
                     per year. 
                 </p>
                 <p>
                     As part of the most recent World Values Survey, UK citizens were asked to rate the justifiability of 
                     cheating on taxes. When asked about it their evaluation of this behaviour on a scale from 1 = never 
                     justifiable, to 10 = always justifiable, only about 9 out of each 100 citizens (8.5 % to be exact) 
                     selected an option above 5. Based on this information, we can see that only a very small portion 
                     (less than 9%) of UK citizens think that it can be justifiable to cheat on taxes.
                </p>
                ";
        break;
    case 2:
        echo "
                <p>
                    Before you start making decisions about paying taxes in this study, we would like to give you an idea 
                    about the tax norms in the UK. People may have different ideas about other citizens’ tax morals. Some 
                    might underestimate, whereas some might overestimate the number of citizens who believe people should
                    be honest when reporting their taxes. To make sure that every participant in this study has access to
                    this information before they make their tax decisions, we present you with an overview of how other 
                    UK citizens think about tax compliance:
                 </p>
                 <p>
                     The World Values Survey is one of the most credible worldwide surveys, and it has been carried out 
                     since 1981. These surveys are nationally representative and reach out to almost 400,000 participants 
                     per year. 
                 </p>
                 <p>
                      As part of the most recent World Values Survey, UK citizens were asked about the justifiability of
                      cheating on taxes. About 56 out of each 100 citizens (56.1 % to be exact) said that it is never 
                      justifiable to cheat on taxes. Based on this information, we can see that a large portion (almost 
                      half) of UK citizens think it may be justifiable to cheat on taxes.
                </p>
                ";
        break;
    default:
        echo "WARNING: Could not find presentation info!";
}

echo("
   <form action='include/experiment/index.php?round=1&mode=1&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation' method='post'>
   <input type='hidden' value='$data' id='data' name='data' >
   <input type='hidden' value='$roundData' id='roundData' name='roundData'>
   <label></label>
   <input type='submit' value='Start Experiment!'>
</form>
");
include("./templates/footer.php");
