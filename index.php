<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

require_once('./resources/config.php');

require_once ("public/templates/header.php");

?>

<p>Production Version 1.1 (Apr 2019)</p>

<b>Recent Changes</b>
<ul>

 <li>Fix: Recording start/end times works correctly</li>
 <li>Fix: Deleted all debug messages --> now everything is in browser console</li>
 <li>Fix: Text and content adjustments.</li>
</ul>

<br>
<b> To Do
</b>
<ul>
    <li>Run exp. a couple of times, see how it goes.</li>
</ul>

<div>
    <h1>Welcome, researcher</h1>
    <p> please enter the participant's name or experiment number below. </p>


    <div>
        <?php
        include("./resources/library/mlwebphp_100beta/mlweb_start_random.html");
        ?>
        <p>Note: If you leave the condition nr. field empty (or enter anything else than value between 1 and 8), a random condition is selected.
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

<?php require_once("public/templates/footer.php"); ?>
