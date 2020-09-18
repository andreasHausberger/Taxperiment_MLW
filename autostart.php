<?php

require_once ('code/code.php');
require_once ('resources/config.php');
require_once ('public/templates/header.php');

    $prolificPID = getParamValue("PROLIFIC_PID", "noName");
    $studyID = getParamValue("STUDY_ID");
    $sessionID = getParamValue("SESSION_ID");
    $randomCondition = rand(1, 6);

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
                linkstr =  "/public/include/intro/index.php?condition=6";
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

<br>

    <?php
        echo "<button onclick=startExp(\"$prolificPID\")> 
        Start Study!
    </button> ";

?>

<?php
require_once ('public/templates/footer.php');

?>


