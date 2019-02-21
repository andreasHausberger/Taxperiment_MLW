<div class="siteContainer">
    <div class="contentContainer">
            <b>Sampling?</b>

        <form>
            <input type="hidden" id="testweek" name="testweek">
            <input type="radio" name="sampling" value="test-week-eligible" onclick="enableButton(true)"> Test-week eligible <br>
            <input type="radio" name="sampling" value="not-test-week" onclick="enableButton(false)"> Not a test-week student
        </form>

    </div>
</div>

<script>

    $(document).ready(function() {
       $('#continueButton').attr("disabled", "disabled");
    });

    function enableButton(isTestweek) {
        document.getElementById('continueButton').disabled = false;

        if (isTestweek) {
            document.getElementById("testweek").value = "1"
        }
        else {
            document.getElementById("testweek").value = "0"

        }
    }
</script>

