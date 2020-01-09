<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

require_once('./resources/config.php');

require_once("public/templates/header.php");

?>

<p>Development Version 1.1.4 (Jan 2020)</p>

<b>Recent Changes</b>
<ul>
    <li>Rework of Tutorial: New Page names, simpler layout</li>
    <li>Risk Aversion Questionnaire</li>
    <li>2 Examples of Audits</li>
</ul>

<br>
<b> To Do </b>
<ul>
    <li>Conditions & Randomization --> Implementaiton & Review</li>
    <li>Content: Post-Experiment Questionnaire</li>
    <li>Review of all Changes</li>
</ul>


<div>
    <h1>Welcome, researcher</h1>
    <p> please enter the participant's name or experiment number below. </p>


    <div>
        <?php
        include("./resources/library/mlwebphp_100beta/mlweb_start_random.html");
        ?>
        <p>Note: If you leave the condition nr. field empty (or enter anything else than value between 1 and 8), a
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
