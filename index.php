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

<p>Dev Notes: Version 0.97.1 (Mar 2019)</p>

<b>Recent Changes</b>
<ul>
   <li>New: Tutorial informs participants whether they will receive instant or delayed feeback. </li>
   <li>New: Random round selection at the end of the Questionnaire (randomly selects a single round, informs participant how much they earned). </li>
   <li>Fix: Tax Input field ignores "Enter" key, preventing illicit submissions.</li>
   <li>Fix: Tax Input field no longer provides suggestions.</li>
   <li>Fix: Questionnaire items are reworded, scales are adapted, all headlines are deleted. </li>
   <li>Fix: Questionnaire ends properly after "Demographics" page.</li>
   <li>Fix: Download page no longer required password. </li>
    <li style="color:darkgreen">Fix: Incorrect tax due was subtracted in case of an honest audit </li>
    <li style="color: darkgreen">Fix: Test mode was activated erroneously at the end of questionnaire. </li>
</ul>

<br>
<b> To Do
</b>
<ul>
    <li>Hiding "Dev Notes" (will do for production)</li>
    <li>"Extra Page" between Slider and Audit to prevent accidental Mouselab input. --> Still working on a solution.</li>
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
