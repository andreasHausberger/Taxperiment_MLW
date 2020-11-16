<div class="siteContainer">
    <div class="contentContainer">
        <p class="tutorialText">
            The examples are now finished. On the next page the actual study begins. Information on earned income,
            tax due, audit probability, and fine for each round will be displayed with MouselabWEB. This means that
            the information is hidden in boxes. These boxes are labeled. To access the respective information, you
            have to move the mouse pointer over the box on the screen. As long as the pointer is over the box, it will
            display the information. Whenever the pointer moves out of the box, the box closes and the information is
            hidden again. Please see the example below and make yourself familiar with how the boxes open and close. 
            Please click either on “Pay tax” or “Don’t pay tax” to make a decision. As noted, this is just an example 
            and the actual decisions will follow shortly. 
        </p>

        <?php

        $taxRate = 0.3;
        $auditProbability = 0.1;
        $fineRate = 1;
        $sureGain = 700;
        $income = 1000;
        $evEvasion = 940;
        $currentCondition = 1;

        $nextPage = 10;

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
            <?php
            if($condition == 1) {
                getAuditButtons(true);
            }
            else {
                getAuditButtons();
            }
             ?>

        </div>
    </div>
</div>