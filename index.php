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

<p>Dev Notes: Version 0.95 (Mar 2019)</p>

<b>Recent Changes</b>
<ul>
    <li>Download of Experiment data via Datalyser works</li>
    <li>Overview of Round performance after experiment</li>
    <li>Demo of Mouselab Tables in tutorial</li>
    <li>Various fixes for bugs, typos etc. </li>
</ul>

<br>
<b> To Do
</b>
<ul>
    <li>Download of Round performance data in .csv Format (also in Datalyser)</li>
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
