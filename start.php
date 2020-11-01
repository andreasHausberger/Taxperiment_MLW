<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

?>

<p>Staging Version 1.2.6 (November 2020)</p>

<b>Recent Changes</b>
<ul>
    <li>Big Tutorial Rewrite: New Texts, new Pages, new Elements. </li>
    <li>Added English Translations to Experiment pages. </li>
    <li>Bug fixes and performance improvements </li>
</ul>

<br>
<b> To Do</b>

<ul>
    <li>SVGs will be updated - is everything working?</li>
    <li>PROLIFIC Info, Resolution Capture Review</li>
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
