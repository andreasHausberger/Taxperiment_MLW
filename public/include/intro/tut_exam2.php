


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
            $(function() {
                let condition = <?php echo $condition ?>;

                if (condition && condition == 1) {
                    $(".signContainer").hide();
                    console.log("Hid sign container for condition 1");
                }
            })
        </script>

        <div id="taxInputContainer">
            <!--        <input class="noEnter" type="text" id="inputValue" onkeyup="validateInput()" autocomplete="off"> <div id="inputFeedback"></div>-->
            <br>
            <?php getAuditButtons(); ?>


        </div>
    </div>
</div>