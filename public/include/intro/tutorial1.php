<div class="siteContainer">
    <div class="contentContainer">
            <b>Sampling?</b>

        <form action="">
            <input type="radio" name="sampling" value="test-week-eligible" onclick="enableButton()"> Test-week eligible <br>
            <input type="radio" name="sampling" value="not-test-week" onclick="enableButton()"> Not a test-week student
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