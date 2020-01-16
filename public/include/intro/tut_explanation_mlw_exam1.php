<div class="siteContainer">
    <div class="contentContainer">
        <h2>Übungsaufgabe</h2>
        <p class="tutorialText">
            Wie bereits erklärt, erhalten Sie in jeder Runde verschiedene Informationen, 
            um Ihre Entscheidung zu treffen. Diese Informationen sind hinter Boxen verborgen. 
            Sie können diese Informationen einsehen indem Sie mit der Maus über die jeweilige Box fahren. 
            Solange Sie mit der Maus auf der Box bleiben wird der dahinter liegenden Inhalt angezeigt. 
            Bewegen Sie die Maus aus der Box hinaus, schließt sich diese wieder. <br>
            <br>
            Bevor Sie mit dem eigentlichen Experiment beginnen, folgen nun zwei Übungsaufgaben um Sie mit diesem System vertraut zu machen. 
            Sehen Sie sich das Beispiel unten an und machen Sie sich bitte mit dem Öffnen und Schließen der Boxen vertraut.
        </p>

        <?php

        $taxRate = 0.4;
        $auditProbability = 0.2;
        $fineRate = 1;
        $sureGain = 900;
        $income = 1500;

        $nextPage = 8;

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