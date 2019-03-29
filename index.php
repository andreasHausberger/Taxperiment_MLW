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

<p>Dev Notes: Version 0.96 (Mar 2019)</p>

<b>Recent Changes</b>
<ul>
   <li>Layout revision: Experiment page is centered in screen, with a minimal width of 650px</li>
   <li>New: Download of questionnaire and audit/round data --> All Conditions in one file. </li>
   <li>Fix: Overview is presented only for participants in "delayed feedback" condition. </li>
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
