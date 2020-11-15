<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

?>

<p>Relea Version 1.2.15 (November 2020)</p>

<b>Recent Changes</b>
<ul>
  <li>Saving of Comprehension Task (in Tutorial)</li>
    <li>Last page info has been updated & reformatted</li>
    <li>Auto-hides Pay/Don't Pay Buttons when clicked (prevents duplicate round entry)</li>
    <li>Many bug fixes. </li>
</ul>

<br>
<b> To Do</b>
    <li>Decision: Is everything working as expected? </li>
<ul>
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
