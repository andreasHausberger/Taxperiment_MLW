<?php



$prolificPID = $sessionID = $studyID = null;
if (count($_GET) > 0) {
    $prolificPID = $_GET["PROLIFIC_PID"];
    $studyID = $_GET["STUDY_ID"];
    $sessionID = $_GET["SESSION_ID"];

    $autoStart = $_GET["auto"];
}

?>

<p>Demo Version 1.1.11 (September 2020)</p>

<b>Recent Changes</b>
<ul>
    <li>No condition 1 from auto-start. Automatic redirect C1 -> C6</li>
</ul>

<b> To Do</b>
<ul>

</ul>


<div>
    <h1>Welcome, researcher</h1>
    <p> please enter the participant's name or experiment number below. </p>
    <p>The current DB host is <?php echo DB_Host ?>. </p>


    <div>
        <?php
        include("./resources/library/mlwebphp_100beta/mlweb_start_random.php");
        ?>
        <p>Note: If you leave the condition nr. field empty (or enter anything else than value between 1 and 6), a
            random condition is selected.
        </p>
    </div>

    <div>
        <a href="resources/library/designer_100beta/index.html"> Link to Designer</a>
    </div>
    <div>
        <a href="download.php">Link to Data Download</a>
    </div>
    <div>
        <a href="public/include/experiment/feedback.php"> Link to Questionnaire (Demo)</a>
    </div>
</div>