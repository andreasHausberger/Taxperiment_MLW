<div class="siteContainer">
    <div class="contentContainer">

        <h3>Einwilligung zur Teilnahme</h3>

        <p class="tutorialText">
            Lorem Ipsum Dolor Sit Amet.
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