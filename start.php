<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 19.11.18
 * Time: 10:01
 */

?>

<p>Staging Version 1.2.14 (November 2020)</p>

<b>Recent Changes</b>
<ul>
  <li>Fix: Correct saving & processing of Visual Cue data</li>
  <li>Visual Cue Box now has a Pointer as cursor</li>
  <li>Martin's Changes as of 12.11.2020, 19:20</li>
</ul>

<br>
<b> To Do</b>

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
