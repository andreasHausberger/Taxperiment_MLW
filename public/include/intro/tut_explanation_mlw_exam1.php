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

        $taxRate = 0.3;
        $auditProbability = 0.1;
        $fineRate = 1;
        $sureGain = 700;
        $income = 1000;
        $evEvasion = 940;
        $currentCondition = 1;

        $nextPage = 8;

        if (isset($_GET['condition'])) {
            $condition = $_GET['condition'];

            if ($condition == 1 || $condition == 2) {
                include("../../../resources/templates/presentation_demo_group1.php");
            }
            elseif ($condition == 3 || $condition == 4) {
                include("../../../resources/templates/presentation_demo_group2.php");
            }
            else {
                echo "Could not read condition!";
            }
        }
        else {
            echo "Could not load MLW table!";
        }
        ?>

        <script>
                let condition = <?php echo $condition ?>;

                let sureGain = <?php echo $sureGain ?>;
                let evEvasion = <?php echo $evEvasion ?>;

                let angle = 135;
        </script>
        <script src="/public/js/exam.js">
        </script>

        <div id="taxInputContainer">
            <br>
            <?php getAuditButtons() ?>

        </div>
    </div>
</div>