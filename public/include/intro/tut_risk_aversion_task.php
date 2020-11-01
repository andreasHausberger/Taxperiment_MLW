<div class="siteContainer">
    <div class="contentContainer">
        <h2>Erster Teil</h2>
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

            <form action="/public/templates/saveAndRedirect.php" method="POST" name="risk_aversion_form">
                <input type="hidden" name="page" value=<?php echo $_GET['page'] ?>>
                <input type="hidden" name="condition" value=<?php echo $_GET['condition'] ?>>
                <input type="hidden" name="subject" value=<?php echo $_GET['sname'] ?>>
                <?php
                $rowArray = [
                    [
                        "rowName" => "row_1",
                        "probA1" => "10",
                        "ecuA1" => "200",
                        "probA2" => "90",
                        "ecuA2" => "160",
                        "probB1" => "10",
                        "ecuB1" => "385",
                        "probB2" => "90",
                        "ecuB2" => "10",
                    ],
                    [
                        "rowName" => "row_2",
                        "probA1" => "20",
                        "ecuA1" => "200",
                        "probA2" => "80",
                        "ecuA2" => "160",
                        "probB1" => "20",
                        "ecuB1" => "385",
                        "probB2" => "80",
                        "ecuB2" => "10",
                    ],
                    [
                        "rowName" => "row_3",
                        "probA1" => "30",
                        "ecuA1" => "200",
                        "probA2" => "70",
                        "ecuA2" => "160",
                        "probB1" => "30",
                        "ecuB1" => "385",
                        "probB2" => "70",
                        "ecuB2" => "10",
                    ],
                    [
                        "rowName" => "row_4",
                        "probA1" => "40",
                        "ecuA1" => "200",
                        "probA2" => "60",
                        "ecuA2" => "160",
                        "probB1" => "40",
                        "ecuB1" => "385",
                        "probB2" => "60",
                        "ecuB2" => "10",
                    ],
                    [
                        "rowName" => "row_5",
                        "probA1" => "50",
                        "ecuA1" => "200",
                        "probA2" => "50",
                        "ecuA2" => "160",
                        "probB1" => "50",
                        "ecuB1" => "385",
                        "probB2" => "50",
                        "ecuB2" => "10",
                    ],
                    [
                        "rowName" => "row_6",
                        "probA1" => "60",
                        "ecuA1" => "200",
                        "probA2" => "40",
                        "ecuA2" => "160",
                        "probB1" => "60",
                        "ecuB1" => "385",
                        "probB2" => "90",
                        "ecuB2" => "40",
                    ],
                    [
                        "rowName" => "row_7",
                        "probA1" => "70",
                        "ecuA1" => "200",
                        "probA2" => "30",
                        "ecuA2" => "160",
                        "probB1" => "70",
                        "ecuB1" => "385",
                        "probB2" => "30",
                        "ecuB2" => "10",
                    ],
                    [
                        "rowName" => "row_8",
                        "probA1" => "80",
                        "ecuA1" => "200",
                        "probA2" => "20",
                        "ecuA2" => "160",
                        "probB1" => "80",
                        "ecuB1" => "385",
                        "probB2" => "90",
                        "ecuB2" => "20",
                    ],
                    [
                        "rowName" => "row_9",
                        "probA1" => "90",
                        "ecuA1" => "200",
                        "probA2" => "10",
                        "ecuA2" => "160",
                        "probB1" => "90",
                        "ecuB1" => "385",
                        "probB2" => "10",
                        "ecuB2" => "10",
                    ],
                    [
                        "rowName" => "row_10",
                        "probA1" => "100",
                        "ecuA1" => "200",
                        "probA2" => "00",
                        "ecuA2" => "160",
                        "probB1" => "100",
                        "ecuB1" => "385",
                        "probB2" => "0",
                        "ecuB2" => "10",
                    ],
                ];
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
