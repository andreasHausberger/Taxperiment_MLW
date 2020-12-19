<?php

require_once ('code/code.php');
require_once ('resources/config.php');
require_once ('public/templates/header.php');

$prolificPID = getParamValue("PROLIFIC_PID", "noName");
$studyID = getParamValue("STUDY_ID");
$sessionID = getParamValue("SESSION_ID");
$randomCondition = rand(1, 4);

?>

<script language="javascript">
    function startExp(subjectName) {
// randomizer for 6 conditions
// this script will choose one of six links randomly
// it also sets the subject and condnum in a cookie
// test.
//calculate random number
        var selectedCondition = Math.floor(Math.random() * 4) + 1;


        switch (selectedCondition) {
            case 1:
                // link for condition 1
                linkstr =  "/public/include/intro/index.php?action=create_participant&condition=1";
                break;

            case 2:
                // link for condition 2
                linkstr = "/public/include/intro/index.php?action=create_participant&condition=2";
                break;

            case 3:
                // link for condition 3
                linkstr = "/public/include/intro/index.php?action=create_participant&condition=3";
                break;

            case 4:
                // link for condition 4
                linkstr = "/public/include/intro/index.php?action=create_participant&condition=4";
                break;

            default:
                break;
        }


        //http://mlweb:8888/public/include/intro/index.php?action=create_participant&condition=4&sname=bc1a1f5e1875e3916492b3b509f58cd420eba1d5&prolificPID=123&studyID=abc&sessionID=asdf&page=1
        subject = subjectName;
        condnum = selectedCondition;

        let prolificPID = "<?php echo $prolificPID?>";
        let studyID = "<?php echo $studyID; ?>";
        let sessionID = "<?php echo $sessionID; ?>";
// set cookies
        document.cookie = "mlweb_condnum=" + condnum + "; path=/";
        document.cookie = "mlweb_subject=" + subject + "; path=/";

        let screenHeight = screen.height;
        let screenWidth = screen.width;

        let resolution = screenWidth + "x" + screenHeight

        var newWind = window.open(linkstr + "&sname=" + subject + "&prolificPID=" + prolificPID + "&studyID=" + studyID + "&sessionID=" + sessionID + "&resolution=" + resolution + "&page=1", "survey", "height=" + (1000).toString() + ",width=" + (1200).toString() + ",scrollbars,status,resizable, left=2, top=2")

    }
</script>

<h1> Welcome Participant!</h1>
<p>Note: Autostart is disabled in this version!</p>
<br>

<?php
$nameCypher = sha1(strval(rand()));
echo "<button class='btn btn-primary' disabled='disabled' onclick=startExp(\"$nameCypher\")> 
        Start Study
    </button> ";

?>

<?php
require_once ('public/templates/footer.php');

?>


