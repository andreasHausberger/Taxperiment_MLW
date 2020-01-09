<div class="siteContainer">
    <div class="contentContainer">
        <h2>Erklärung und 1. Prüfung</h2>
        <p class="tutorialText">
            Hier steht ein Erklärungstext, anschließend gibt es ein Beispiel, dessen Daten nicht ausgewertet werden. Alles, was innerhalb der php-Klammer steht, sollte besser nicht verändert werden.
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