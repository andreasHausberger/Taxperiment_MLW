<div class="siteContainer">
    <h2>Declaration of participation
    </h2>

    <div class="contentContainer">

        <p class="tutorialText">
            I hereby confirm that I have read all the information on the previous page.
        </p>
        <p class="tutorialText">
            I know that participation is voluntary and that I have the right to decline to participate and withdraw from
            the research once participation has begun, without any negative consequences and without providing any
            explanation.
        </p>
        <p class="tutorialText">
            I give permission for the processing of the anonymous data as mentioned in the information letter and I give
            permission for the storing of the research data online for an undetermined period of time.

        </p>
        <form action="">
            <p class="tutorialText">I hereby state that I want to participate in this study:
            </p>
            <input type="radio" name="sampling" value="consent-yes" onclick="enableButton()">
            Yes, I confirm and want to participate.
            <br>
            <input type="radio" name="sampling" value="consent-no" onclick="displayMessage()">
            No, I do not want to participate.
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

        document.getElementById("messageDisplay").innerText = "If you decline to participate, please notify the test supervisor!"
    }
</script>