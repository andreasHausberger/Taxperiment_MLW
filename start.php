<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

?>

<p>Staging Version 1.2.8 (November 2020)</p>

<b>Recent Changes</b>
<ul>
    <li>SVGs are centered, zoomed in</li>
    <li>No more Presentation Randomization between rounds.</li>
    <li>Post Exp. Knowledge pages: Now 2 pages, second one is conditional on first one.</li>
    <li>Several Fixes and Improvements (Trello List)</li>
    <li>Changes by Martin (04.11., 21:18)</li>
</ul>

<br>
<b> To Do</b>

<ul>
    <li>Resolution Capture Review</li>
    <li>Make Tables downloadable as .csv</li>
</ul>

<div>
    <h1>Welcome, researcher</h1>
    <p> please enter the participant's name or experiment number below. </p>


    <div>
        <?php
        include("./resources/library/mlwebphp_100beta/mlweb_start_random.html");
        ?>
        <p>
            Note: If you leave the condition nr. field empty (or enter anything else than values between 1 and 4), a
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

<?php require_once("public/templates/footer.php"); ?>
