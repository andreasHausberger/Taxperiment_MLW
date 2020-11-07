<div class="siteContainer">
    <div class="contentContainer">
        <h2>First Part</h2>
        <p class="tutorialText">
            The first part of the study starts now. You will be presented with 10 lottery pairs. For each lottery pair,
            please choose either “Option A” or “Option B”. You will make 10 decisions, however, only one of these
            decisions will be randomly selected to determine your payment at the end of the study.
        </p>
        <p class="tutorialText" >
            Before you make your decisions, please look at the structure of the lottery pairs. For decision 1 (first row): <br>
            Option A pays 200 ECU with a probability of 10% and 160 ECU with a probability of 90%; <br>
            Option B pays 385 ECU with a probability of 10% and 10 ECU with a probability of 90%.

        </p>
        <p class="tutorialText" >

            The following lottery pairs (row 2 - row 10) are similar with the exception of increasing probabilities for
            the higher payments the further down they are in the table. In row 10 the higher payment will be a sure
            outcome for both Options, so that your decision is between 200 ECU (Option A) and 385 ECU (Option B).
        </p>
        <p class="tutorialText">
            In conclusion, you will make 10 decisions: For each decision you will choose between Option A and Option B.
            You may choose Option A for some lottery pairs and Option B for others. Furthermore, you may change your
            decisions and make them in any order of your preference.

        </p>

            
        </p>
    </div>

    <div class="mlwContentContainer">
        <div class="riskAversionQuestionnaireContainer">

            <form action="/public/include/intro/index.php?action=save_questionnaire&condition=<?php echo $_GET['condition'] ?>&sname=<?php echo $participant?>&prolificPID=<?php echo $prolificPID?>&studyID=<?php echo $studyID?>&sessionID=<?php echo $sessionID?>&page=7" method="post">
                <input type="hidden" name="page" value=<?php echo $_GET['page'] ?>>
                <input type="hidden" name="condition" value=<?php echo $_GET['condition'] ?>>
                <input type="hidden" name="subject" value=<?php echo $_GET['sname'] ?>>
                <?php
                $rowArray = $riskTaskArray;
                createRiskAversionTask($rowArray);
                ?>
                <input id="riskAversionNextButton" style="margin-right: 99%; margin-top: 32px" type="submit" name="Submit" value="Next">
            </form>
        </div>

    </div>
</div>

<script type="application/javascript">
$(function() {
    $('#riskAversionNextButton').prop('disabled', true);
    var answers = [];

    $(".riskAversionInput").on('click', function() {
        let name = $(this).attr('name');

        if (!answers.includes(name)) {
            answers.push(name);
        }

        if (answers.length == 10) {
            $("#riskAversionNextButton").prop('disabled', false);
        }
    })
})
</script>

<!-- Anmerkungen:
    <h2> Headline </h2> für Überschriften
    <h3> Subhead </h3> für Unter-Überschriften
    <div class="contentContainer"> Content </div> für den gesamten Text (Content -> Mehrere Absätze)
    <p class="tutorial_text"> Paragraph </p> für Absätze. Mit <br> können Zeilenbrüche innerhalb von Absätzen eingefügt werden
    <a href="https://univie.ac.at"> Link </a> für Links. Für Emails statt einer URL href="mailto:test@univie.ac.at" einfügen.
 -->
