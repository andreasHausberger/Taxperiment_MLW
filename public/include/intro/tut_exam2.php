


<div class="siteContainer">
    <div class="contentContainer">
        <h2>Übungsaufgabe 2 </h2>

        <p class="tutorialText">
            Sehen Sie sich das Beispiel unten an und machen Sie sich bitte mit dem Öffnen und Schließen der Boxen vertraut.
        </p>


        <?php

        $taxRate = 0.5;
        $auditProbability = 0.25;
        $fineRate = 3;
        $sureGain = 1500;
        $income = 3000;
        $evEvasion = 1500;
        $currentCondition = 7;


        $subjectID = $dataArray['pid'];
        //var_dump($subjectID);
        $experimentID = $_GET['expid'];
        $participantID = $_GET['pid'];
        $currentRound = $_GET['round'];
        $condition = $_GET['condition'];
        $nextRound = $_GET['round'] + 1;
        $nextMode = $_GET['mode'] == 2 ? 1 : 2;

        $nextPage = 9;

        if (isset($_GET['condition'])) {

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

            let angle = 45;
        </script>
        <script src="/public/js/exam.js"></script>

        <div id="taxInputContainer">
            <?php getAuditButtons() ?>


        </div>
    </div>
</div>