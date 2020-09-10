<div class="siteContainer">
    <div class="contentContainer">
            <p class="textSpan">
                I hereby confirm that I have read all the information.
            </p>
            <p class="textSpan">
                I know that participation is voluntary and that I have the right to decline to participate and withdraw from the research once participation has begun, without any negative consequences, and without providing any explanation.
            </p>

            <p class="textSpan">
                I give permission for the processing of the anonymous data and I give permission for the storing of the research data online for an undetermined period of time.
            </p>

        <form action="">
            <p class="textSpan">I hereby state that I want to participate in this study:
            </p>
            <p class="textSpan">
                <input type="radio" name="sampling" value="consent-yes" onclick="enableButton()"> Yes, I confirm and want to participate <br>
                <input type="radio" name="sampling" value="consent-no" onclick="displayMessage()"> No, I don't want to participate
            </p>

        </form>

        <p class="textSpan" id="messageDisplay"></p>


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

        document.getElementById("messageDisplay").innerText = "If you don't want to participate, please simply close your internet browser."
    }
</script>
