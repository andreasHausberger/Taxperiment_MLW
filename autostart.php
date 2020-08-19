<?php

require_once ('resources/config.php');
require_once ('public/templates/header.php');

if (count($_GET) > 0) {
    $active = false;
    $prolificPID = $_GET["PROLIFIC_PID"];
    $studyID = $_GET["STUDY_ID"];
    $sessionID = $_GET["SESSION_ID"];

    $autoStart = $_GET["auto"];

    $randomCondition = rand(1, 6);

    $linkString = "";
    if ($prolificPID != null && $studyID != null && $sessionID != null) {
        $active = true;
        $linkString = "/public/include/intro/index.php?condition=$randomCondition";
    }

}




?>

<script language="javascript">
    function startExp(subjectName) {
// randomizer for 6 conditions
// this script will choose one of six links randomly
// it also sets the subject and condnum in a cookie

//calculate random number
    var selectedCondition = Math.floor(Math.random() * 6) + 1;


        switch (selectedCondition) {
            case 1:
                // link for condition 1
                linkstr =  "/public/include/intro/index.php?condition=1";
                break;

            case 2:
                // link for condition 2
                linkstr = "/public/include/intro/index.php?condition=2";
                break;

            case 3:
                // link for condition 3
                linkstr = "/public/include/intro/index.php?condition=3";
                break;

            case 4:
                // link for condition 4
                linkstr = "/public/include/intro/index.php?condition=4";
                break;

            case 5:
                // link for condition 5
                linkstr = "/public/include/intro/index.php?condition=5";
                break;

            case 6:
                // link for condition 6
                linkstr = "/public/include/intro/index.php?condition=6";
                break;

            default:
                break;
        }

        subject = subjectName
        condnum = selectedCondition;

        let prolificPID = "<?php echo $prolificPID?>";
        let studyID = "<?php echo $studyID; ?>";
        let sessionID = "<?php echo $sessionID; ?>";
// set cookies
        document.cookie = "mlweb_condnum=" + condnum + "; path=/";
        document.cookie = "mlweb_subject=" + subject + "; path=/";

        var newWind = window.open(linkstr + "&sname=" + subject + "&prolificPID=" + prolificPID + "&studyID=" + studyID + "&sessionID=" + sessionID +"&page=1", "survey", "height=" + (1000).toString() + ",width=" + (1200).toString() + ",scrollbars,status,resizable, left=2, top=2")

    }
</script>

<h1> Welcome Participant!</h1>

<div style="margin-top: 15px;">
    <b>Prolific PID:</b>
    <p> <?php echo $prolificPID ?></p>
    <b>Study ID:</b>
    <p> <?php echo $studyID ?></p>
    <b>Session ID:</b>
    <p> <?php echo $sessionID ?></p>
</div>

    <?php
    if ($active) {
        echo "<button onclick=\"startExp($prolificPID)\"> 
        Start experiment
    </button> ";
    }
    else {
        echo "<h2 style='color: darkred'> Warning: Cannot start experiment without all required parameters! </h2>";
    }

?>

<?php
require_once ('public/templates/footer.php');

?>


