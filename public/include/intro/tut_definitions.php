<div class="siteContainer">

    <!--
        Anmerkung: Die Inhalte in den Containern mit den ids 'explanationCondition1' usw. werden nur für die jeweilige Condition angezeigt.
        Bitte überprüfen, ob auf den Testrechnern Javascript aktiviert ist (sollte eig. schon der Fall sein), sonst bleibt diese Seite leer.
      -->
    <div class="contentContainer">
        <div id="explanationCondition1" style="display: none">
            
            <embed src="/public/img/Cond1_p20.svg" alt="SVG mit img Tag laden" height="575">
            
<!--            <h2>Decision</h2>-->
<!---->
<!--            <p class="tutorialText">-->
<!--               For each of the decisions, you will receive all the relevant information in an information matrix similar to the one below. -->
<!--               You can consider this information in your decision to either pay or evade the taxes, by clicking on one of the two options highlighted in yellow.-->
<!--            </p>-->
<!---->
<!--            <b>Steuersatz</b>-->
<!--            <p class="tutorialText">-->
<!--                Der Steuersatz ist ein Prozentsatz des Einkommens, welcher als Steuer gefordert wird.-->
<!--                Beträgt dieser beispielsweise 30% bei einem Einkommen von 1000, so werden 300 als Steuerzahlung gefordert.-->
<!--            </p>-->
<!---->
<!--            <b>Prüfwahrscheinlichkeit</b>-->
<!--            <p class="tutorialText">-->
<!--                Jede Runde kann eine Steuerprüfung stattfinden, um zu überprüfen ob die geforderte Steuer korrekt gezahlt wurde.-->
<!--                Die Wahrscheinlichkeit einer Steuerprüfung wird mit einem Prozentsatz angegeben.-->
<!--                Sollten Sie geprüft werden und Sie haben die geforderte Steuer gezahlt, bleibt die Steuerprüfung ohne Konsequenzen.-->
<!--                Sollten Sie geprüft werden und Sie haben die geforderte Steuer nicht gezahlt, kommt zu einer Strafe (siehe Feld Strafhöhe).-->
<!--            </p>-->
<!---->
<!--            <b>Strafhöhe</b>-->
<!--            <p class="tutorialText">-->
<!--                Die Strafhöhe bestimmt wieviel Sie zahlen müssen, falls Sie die geforderte Steuer nicht bezahlt haben und eine Steuerprüfung stattgefunden hat.-->
<!--                Die Strafhöhe setzt sich aus der nicht gezahlten Steuer plus einer zusätzlichen Strafe zusammen.-->
<!--            </p>-->
<!---->
<!--            <b>Sicherer Ausgang</b>-->
<!--            <p class="tutorialText">-->
<!--                Der sichere Ausgang ist der Wert den Sie erhalten, wenn Sie die Steuer wie gefordert zahlen.-->
<!--                Der Wert ergibt sich aus dem Einkommen abzüglich der geforderten Steuer.-->
<!--            </p>-->
<!---->
<!--            <b>Erwartungswert (EW): Hinterziehung</b>-->
<!--            <p class="tutorialText">-->
<!--                Entscheiden Sie sich dazu die geforderte Steuer nicht zu zahlen, gibt es zwei mögliche Ausgänge: <br>-->
<!--                <br>-->
<!--                Mit einer bestimmten Wahrscheinlichkeit werden Sie geprüft und müssen eine Strafe zahlen.-->
<!--                In diesem Fall bleibt Ihnen das Einkommen minus der Strafe. <br>-->
<!--                <br>-->
<!--                Mit der Gegenwahrscheinlichkeit findet keine Prüfung statt und Sie behalten das gesamte Einkommen ohne Steuern gezahlt zu haben. <br>-->
<!--                <br>-->
<!--                Stellt man diese beiden Ausgänge unter Berücksichtigung ihrer jeweiligen Wahrscheinlichkeit gegenüber, erhält man einen Wert der-->
<!--                den durchschnittlichen Ausgang einer Steuerhinterziehung darstellt. Dieser wird hier angezeigt. <br>-->
<!--                <br>-->
<!--                Ist der hier angegebene Erwartungswert höher als der sichere Ausgang, ist davon auszugehen, dass es sich rein finanziell lohnt-->
<!--                die Steuer nicht zu zahlen. Hinterziehung Ist der Erwartungswert hingegen kleiner als der sichere Ausgang,-->
<!--                so lohnt sich rein finanziell gesehen eher die geforderten Steuern zu zahlen. <br>-->
<!--                <br>-->
<!--                Der Vergleich des sicheren Ausgangs mit dem Erwartungswert kann also hilfreich sein,-->
<!--                wenn man rein rechnerisch optimale Entscheidungen treffen möchte. <br>-->
<!--            </p>-->
        </div>

        <div id="explanationCondition2" style="display: none">
            <h2>Definitionen</h2>

            <b>Einkommen</b>
            <p class="tutorialText">
                Stellt den Geldbetrag für die aktuelle Runde dar.
            </p>

            <b>Steuersatz</b>
            <p class="tutorialText">
                Der Steuersatz ist ein Prozentsatz des Einkommens, welcher als Steuer gefordert wird.
                Beträgt dieser beispielsweise 30% bei einem Einkommen von 1000, so werden 300 als Steuerzahlung gefordert.
            </p>

            <b>Prüfwahrscheinlichkeit</b>
            <p class="tutorialText">
                Jede Runde kann eine Steuerprüfung stattfinden, um zu überprüfen ob die geforderte Steuer korrekt gezahlt wurde.
                Die Wahrscheinlichkeit einer Steuerprüfung wird mit einem Prozentsatz angegeben.
                Sollten Sie geprüft werden und Sie haben die geforderte Steuer gezahlt, bleibt die Steuerprüfung ohne Konsequenzen.
                Sollten Sie geprüft werden und Sie haben die geforderte Steuer nicht gezahlt, kommt zu einer Strafe (siehe Feld Strafhöhe).
            </p>

            <b>Strafhöhe</b>
            <p class="tutorialText">
                Die Strafhöhe bestimmt wieviel Sie zahlen müssen, falls Sie die geforderte Steuer nicht bezahlt haben und eine Steuerprüfung stattgefunden hat.
                Die Strafhöhe setzt sich aus der nicht gezahlten Steuer plus einer zusätzlichen Strafe zusammen.
            </p>

            <b>Sicherer Ausgang</b>
            <p class="tutorialText">
                Der sichere Ausgang ist der Wert den Sie erhalten, wenn Sie die Steuer wie gefordert zahlen.
                Der Wert ergibt sich aus dem Einkommen abzüglich der geforderten Steuer.
            </p>

            <b>Erwartungswert (EW): Hinterziehung</b>
            <p class="tutorialText">
                Entscheiden Sie sich dazu die geforderte Steuer nicht zu zahlen, gibt es zwei mögliche Ausgänge: <br>
                <br>
                Mit einer bestimmten Wahrscheinlichkeit werden Sie geprüft und müssen eine Strafe zahlen.
                In diesem Fall bleibt Ihnen das Einkommen minus der Strafe. <br>
                <br>
                Mit der Gegenwahrscheinlichkeit findet keine Prüfung statt und Sie behalten das gesamte Einkommen ohne Steuern gezahlt zu haben. <br>
                <br>
                Stellt man diese beiden Ausgänge unter Berücksichtigung ihrer jeweiligen Wahrscheinlichkeit gegenüber, erhält man einen Wert der
                den durchschnittlichen Ausgang einer Steuerhinterziehung darstellt. Dieser wird hier angezeigt. <br>
                <br>
                Ist der hier angegebene Erwartungswert höher als der sichere Ausgang, ist davon auszugehen, dass es sich rein finanziell lohnt
                die Steuer nicht zu zahlen. Hinterziehung Ist der Erwartungswert hingegen kleiner als der sichere Ausgang,
                so lohnt sich rein finanziell gesehen eher die geforderten Steuern zu zahlen. <br>
                <br>
                Der Vergleich des sicheren Ausgangs mit dem Erwartungswert kann also hilfreich sein,
                wenn man rein rechnerisch optimale Entscheidungen treffen möchte. <br>
                <br>
                Genauso wie bei „Sicherer Ausgang“ wird Ihnen nicht der numerische Wert angezeigt, sondern ein Kleinerzeichen (<)
                falls der Wert geringer ist als der Wert von „Sicherer Ausgang“ (siehe Erklärung oben), ein Größerzeichen (>)
                falls der Wert größer ist und ein Ist-Gleich-Zeichen (=) falls beide Werte genau gleich hoch sind.
            </p>
        </div>

        <div id="explanationCondition3" style="display: none">
            <h2>Definitionen</h2>

            <b>Einkommen</b>
            <p class="tutorialText">
                Stellt den Geldbetrag für die aktuelle Runde dar.
            </p>

            <b>Steuersatz</b>
            <p class="tutorialText">
                Der Steuersatz ist ein Prozentsatz des Einkommens, welcher als Steuer gefordert wird.
                Beträgt dieser beispielsweise 30% bei einem Einkommen von 1000, so werden 300 als Steuerzahlung gefordert.
            </p>

            <b>Prüfwahrscheinlichkeit</b>
            <p class="tutorialText">
                Jede Runde kann eine Steuerprüfung stattfinden, um zu überprüfen ob die geforderte Steuer korrekt gezahlt wurde.
                Die Wahrscheinlichkeit einer Steuerprüfung wird mit einem Prozentsatz angegeben.
                Sollten Sie geprüft werden und Sie haben die geforderte Steuer gezahlt, bleibt die Steuerprüfung ohne Konsequenzen.
                Sollten Sie geprüft werden und Sie haben die geforderte Steuer nicht gezahlt, kommt zu einer Strafe (siehe Feld Strafhöhe).
            </p>

            <b>Strafhöhe</b>
            <p class="tutorialText">
                Die Strafhöhe bestimmt wieviel Sie zahlen müssen, falls Sie die geforderte Steuer nicht bezahlt haben und eine Steuerprüfung stattgefunden hat.
                Die Strafhöhe setzt sich aus der nicht gezahlten Steuer plus einer zusätzlichen Strafe zusammen.
            </p>

            <b>Erwartungswert (EW) der Entscheidung</b>
            <p class="tutorialText">
                Wenn Sie die Steuer wie gefordert zahlen, erhalten Sie einen garantierten Wert.
                Dieser beschreibt den sicheren Ausgang der Entscheidung zu zahlen.
                Der Wert ergibt sich aus dem Einkommen abzüglich der geforderten Steuer. <br>
                <br>
                Entscheiden Sie sich dazu die geforderte Steuer nicht zu zahlen, gibt es zwei mögliche Ausgänge: <br>
                <br>
                Mit einer bestimmten Wahrscheinlichkeit werden Sie geprüft und müssen eine Strafe zahlen.
                In diesem Fall bleibt Ihnen das Einkommen minus der Strafe. <br>
                <br>
                Mit der Gegenwahrscheinlichkeit findet keine Prüfung statt und Sie behalten das gesamte Einkommen ohne Steuern gezahlt zu haben. <br>
                <br>
                Stellt man diese beiden Ausgänge unter Berücksichtigung ihrer jeweiligen Wahrscheinlichkeit gegenüber, erhält man einen Wert der
                den durchschnittlichen Ausgang einer Steuerhinterziehung darstellt. Dieser wird hier angezeigt. <br>
                <br>
                Ist der Erwartungswert höher als der sichere Ausgang, ist davon auszugehen, dass es sich rein finanziell lohnt die Steuer nicht zu zahlen.
                Ist der Erwartungswert hingegen kleiner als der sichere Ausgang, so lohnt es sich rein finanziell gesehen eher die geforderten Steuern zu zahlen.  <br>
                <br>
                Der Vergleich des sicheren Ausgangs mit dem Erwartungswert kann also hilfreich sein,
                wenn man rein rechnerisch optimale Entscheidungen treffen möchte. <br>
            </p>
        </div>

        <div class="explanationCondition4" style="display: none">
            <p class="tutorialText">
                Hier sollte eine Weiterleitung stattfinden.
            </p>
        </div>
        
        <?php
        $condition = $_GET['condition'];
        $subjectName = $_GET['sname'];
        $page = $_GET['page'];

        if (!isset($condition) || $condition <= 0) {
            echo "WARNING: COULD NOT READ CONDITION!";
            die;
        }

//        if ($condition == 4) {
//            $nextPage = intval($page) + 1;
//
//            $host = $_SERVER['HTTP_HOST'];
//            $url = $host . '/public/include/intro/index.php?condition=' . $condition . '&sname=' . $subjectName . '&page=' . $nextPage;
//
//            $ch = curl_init();
//
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//
//            curl_exec($ch);
//
//            curl_close($ch);
//        }

        ?>

    </div>

    <script>
        let condition = <?php echo $condition ?>;

        switch (condition) {
            case 1:
                document.getElementById('explanationCondition1').style.display = "block";
                break;
            case 2:
                document.getElementById('explanationCondition2').style.display = "block";
                break;
             case 3:
                 document.getElementById('explanationCondition3').style.display = "block";
                 break;
             case 4:
                 document.getElementById('explanationCondition4').style.display = "block";
                 break;
            default:
                break;
        }
    </script>
</div>