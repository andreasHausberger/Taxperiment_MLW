<div class="siteContainer">
    <div class="contentContainer">
        <p>
            <span class="textSpan">
                I hereby confirm that I have read all the information and that I was given the opportunity to ask questions.
            </span>
            <br>
            <span class="textSpan">
                I know that participation is voluntary and that I have the right to decline to participate and withdraw from the research once participation has begun, without any negative consequences, and without providing any explanation.
            </span>
            <br>
            <span class="textSpan">
                I give permission for the processing of the anonymous data as mentioned in the information letter and I give permission for the storing of the research data online for an undetermined period of time.
            </span>
            <br>
        </p>

        <form action="">
            <span>I hereby state that I want to participate in this study:
            </span> <br>
            <br>
            <input type="radio" name="sampling" value="consent-yes" onclick="enableButton()"> Yes, I confirm and want to participate <br>
            <input type="radio" name="sampling" value="consent-no"> No, I don't want to participate
        </form>

    </div>
</div>

<script>

    $(document).ready(function() {
        $('#continueButton').attr("disabled", "disabled");
    });

    function enableButton() {
        document.getElementById('continueButton').disabled = false;
    }
</script>