


<div class="siteContainer">
    <div class="contentContainer">
        <h2>Übungsaufgabe 2 </h2>

        <p class="tutorialText">
            Sehen Sie sich das Beispiel unten an und machen Sie sich bitte mit dem Öffnen und Schließen der Boxen vertraut.
        </p>


        <?php

        $taxRate = 0.2;
        $auditProbability = 0.3;
        $fineRate = 1;
        $sureGain = 1600;
        $income = 200;

        $subjectID = $dataArray['pid'];
        //var_dump($subjectID);
        $experimentID = $_GET['expid'];
        $participantID = $_GET['pid'];
        $currentRound = $_GET['round'];
        $condition = $_GET['condition'];
        $nextRound = $_GET['round'] + 1;
        $nextMode = $_GET['mode'] == 2 ? 1 : 2;

        $nextPage = 9;

        include("../../../resources/templates/mlw_demo.php");

        ?>

        <div id="taxInputContainer">
            <label for="inputValue">Please choose whether to pay the taxes stated above or to evade completely: </label>
            <!--        <input class="noEnter" type="text" id="inputValue" onkeyup="validateInput()" autocomplete="off"> <div id="inputFeedback"></div>-->
            <br>
            <input type="submit" class="formButton" id="complyButton" value="Pay Taxes" >
            <input type="submit" class="formButton" id="evadeButton" value="Evade Taxes" >

        </div>
    </div>
</div>