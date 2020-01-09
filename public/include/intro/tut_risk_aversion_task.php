<div class="siteContainer">
    <div class="contentContainer">
        <h2>Incentivization</h2>
        <p class="tutorialText">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged. It was popularised in the 1960s with the release of
            Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
            software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
    </div>

    <div class="riskAversionQuestionnaireContainer">

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
                "probA1" => "700",
                "ecuA1" => "200",
                "probA2" => "30",
                "ecuA2" => "160",
                "probB1" => "700",
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
        echo createRiskAversionTask($rowArray);
        ?>
    </div>
</div>

<?php



?>

<!-- Anmerkungen:
    <h2> Headline </h2> für Überschriften
    <h3> Subhead </h3> für Unter-Überschriften
    <div class="contentContainer"> Content </div> für den gesamten Text (Content -> Mehrere Absätze)
    <p class="tutorial_text"> Paragraph </p> für Absätze. Mit <br> können Zeilenbrüche innerhalb von Absätzen eingefügt werden
    <a href="https://univie.ac.at"> Link </a> für Links. Für Emails statt einer URL href="mailto:test@univie.ac.at" einfügen.
 -->
