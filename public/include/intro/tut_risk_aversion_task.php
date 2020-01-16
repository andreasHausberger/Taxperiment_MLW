<div class="siteContainer">
    <div class="contentContainer">
        <h2>Erster Teil</h2>
        <p class="tutorialText">
            Nun beginnen Sie mit dem ersten Teil der Studie. Hier werden Ihnen 10 Entscheidungspaare präsentiert. 
            Bitte wählen Sie für jedes dieser Entscheidungspaare entweder „Option A“ oder „Option B“. Sie werden 10 Entscheidungen treffen, 
            aber nur eine dieser Entscheidungen wird am Ende der Studie ausgewählt und für Ihre Auszahlung herangezogen. 
            Sie wissen daher nicht, welches Lotteriepaar am Ende ausgewählt wird. <br>
            <br>
            Bevor Sie Ihre Entscheidungen treffen, betrachten Sie die Struktur des Problems. 
            Bitte sehen Sie sich Entscheidung 1 (1. Reihe) an: Option A zahlt 200 ECU mit einer Wahrscheinlichkeit von 10% und 160 ECU mit einer Wahrscheinlichkeit von 90%; 
            Option B zahlt 385 ECU mit einer Wahrscheinlichkeit von 10% und 10 ECU mit einer Wahrscheinlichkeit von 90%. <br>
            <br>
            Die anderen Entscheidungen sind ähnlich, außer dass, wenn Sie sich in der Tabelle nach unten bewegen, 
            die Chancen auf eine höhere Auszahlung für jede Option steigen. Tatsächlich erhalten Sie in Entscheidung 10, 
            am Ende der Liste, in jeder Option sicher die höchste Auszahlung, so dass Ihre Wahl hier zwischen 200 ECU (Option A) und 385 ECU (Option B) liegt. <br>
            <br>
            Zusammenfassend lässt sich sagen, dass Sie zehn Entscheidungen treffen werden: Für jede Entscheidung müssen Sie zwischen Option A und Option B wählen. 
            Sie können für einige Entscheidungspaare A und für andere B wählen. Außerdem können Sie Ihre Entscheidungen ändern und in beliebiger Reihenfolge treffen. 
            Wenn Sie fertig sind, klicken Sie auf die Schaltfläche „Weiter“.
            
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
