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

<p>Dev Notes: Version 0.98.1 (Apr 2019)</p>

<b>Recent Changes</b>
<ul>
   <li>New: Extra overlay for audits prevents accidental input.</li>
   <li>New: Processed Exp Data can be downloaded. </li>
   <li>New: Clearer information how to select a condition.  </li>
   <li>Fix: Condition selection works.  </li>
    <li>Fix: Audit Overlay only contains button</li>
    <li>Fix: divisions = 1 is set.</li>
</ul>

<br>
<b> To Do
</b>
<ul>
    <li>Hiding "Dev Notes" (will do for production)</li>
    <li>Run exp. a couple of times, see how it goes.</li>
</ul>

<div>
    <h1>Welcome, researcher</h1>
    <p> please enter the participant's name or experiment number below. </p>

    <div>
        <iframe src="./resources/library/mlwebphp_100beta/mlweb_start_random.html" frameborder="0"></iframe>
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
