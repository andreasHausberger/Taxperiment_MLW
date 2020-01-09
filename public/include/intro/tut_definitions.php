<div class="siteContainer">

    <!--
        Anmerkung: Die Inhalte in den Containern mit den ids 'explanationCondition1' usw. werden nur für die jeweilige Condition angezeigt.
        Bitte überprüfen, ob auf den Testrechnern Javascript aktiviert ist (sollte eig. schon der Fall sein), sonst bleibt diese Seite leer.
      -->
    <div class="contentContainer">
        <div id="explanationCondition1" style="display: none">
            <h2>Definitionen</h2>

            <b>Einkommen</b>
            <p class="tutorialText">
                Stellt den Geldbetrag für die aktuelle Runde dar. Condition 1
            </p>
        </div>

        <div id="explanationCondition2" style="display: none">
            <h2>Definitionen</h2>

            <b>Einkommen</b>
            <p class="tutorialText">
                Stellt den Geldbetrag für die aktuelle Runde dar. Condition 2
            </p>
        </div>

        <div id="explanationCondition3" style="display: none">
            <h2>Definitionen</h2>

            <b>Einkommen</b>
            <p class="tutorialText">
                Stellt den Geldbetrag für die aktuelle Runde dar. Condition 3
            </p>
        </div>

        <div id="explanationCondition4" style="display: none">
            <p> Diese Seite ist leer. Der Entwickler sollte hier eine automatische Weiterleitung einbauen. </p>
        </div>

        <?php
        $condition = $_GET['condition'];

        if (!isset($condition) || $condition <= 0) {
            echo "WARNING: COULD NOT READ CONDITION!";
            die;
        }

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
                 break;
            default:
                break;
        }
    </script>
</div>