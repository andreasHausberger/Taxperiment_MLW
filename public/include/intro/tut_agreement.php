<div class="siteContainer">
    <div class="contentContainer">

        <h3>Einwilligung zur Teilnahme</h3>

        <p class="tutorialText">
            Ich erkläre mich bereit, an der Studie „Untersuchung zu finanziellen Entscheidungen“ teilzunehmen. <br>
            <br>
            Ich bin von einem der Testleiterinnen bzw. Testleiter ausführlich und verständlich über Zielsetzung, 
            Bedeutung und Tragweite der Studie und die sich für mich daraus ergebenden Anforderungen aufgeklärt worden. 
            Ich habe darüber hinaus den Text dieser Teilnehmerinnen Information und Einwilligungserklärung gelesen. 
            Aufgetretene Fragen wurden mir von der Testleitung verständlich und ausreichend beantwortet. 
            Ich hatte genügend Zeit, mich zu entscheiden, ob ich an der Studie teilnehmen möchte. Ich habe zurzeit keine weiteren Fragen mehr. <br>
            <br>
            Ich werde die Hinweise, die für die Durchführung der Studie erforderlich sind, befolgen, 
            behalte mir jedoch das Recht vor, meine freiwillige Mitwirkung jederzeit zu beenden, ohne dass mir daraus Nachteile entstehen. <br>
            <br>
            Ich bin zugleich damit einverstanden, dass die im Rahmen dieser Studie von mir erhobenen Daten anonym aufgezeichnet und gruppenbezogen ausgewertet werden. 
            Ich stimme zu, dass meine Daten dauerhaft in anonymisierter Form elektronisch gespeichert werden. <br>
            <br>
            Den Aufklärungsteil habe ich gelesen und verstanden. Ich konnte im Aufklärungsgespräch alle mich interessierenden Fragen stellen. 
            Sie wurden vollständig und verständlich beantwortet. <br>
            <br>
            Diese Einwilligung verbleibt bei der Projektleitung, die ich bei weiteren Fragen kontaktieren kann (Martin Müller, martin.mueller82@univie.ac.at).          
         
        </p>

        <p class="tutorialText">
            Bitte akzeptieren Sie die Einwilligungserklärung nur
        </p>
        <ul>

            <li>
                wenn Sie Art und Ablauf der Studie vollständig verstanden haben,
            </li>
            <li>
                wenn Sie bereit sind, der Teilnahme zuzustimmen und
            </li>
            <li>
                wenn Sie sich über Ihre Rechte als Teilnehmer/in an dieser Studie im Klaren sind.
            </li>

        </ul>

        </p>

        <form action="">
            <p class="tutorialText">Geben Sie Ihre Einwilligung an der Studie teilzunehmen?
            </p>
            <input type="radio" name="sampling" value="consent-yes" onclick="enableButton()"> Ja, ich stimme zu und möchte teilnehmen. <br>
            <input type="radio" name="sampling" value="consent-no" onclick="displayMessage()"> Nein, ich möchte nicht teilnehmen.
        </form>
        <br>


        <div id="messageDisplay"></div>
        <br>


    </div>
</div>

<script>

    $(document).ready(function() {
        $('#continueButton').attr("disabled", "disabled");
    });

    function enableButton() {
        document.getElementById("messageDisplay").innerText = "";
        document.getElementById('continueButton').disabled = false;
    }

    function displayMessage() {
        document.getElementById('continueButton').disabled = true;

        document.getElementById("messageDisplay").innerText = "Wenn Sie nicht teilnehmen möchten, geben Sie bitte der Testleitung Bescheid!"
    }
</script>