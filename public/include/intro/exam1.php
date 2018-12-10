<script>

    $(document).ready(function() {
        $('#continueButton').attr("disabled", "disabled");
    });


    function checkResult(event) {
        let inputScore = event.target.value;
        if (inputScore == 50) {
            let score = 100;
            event.target.disabled = true;
            totalScore += score;
            console.log("called addToScore with score " + score + " and a totalScore of: " + totalScore);

            document.getElementById('score').setAttribute('value', totalScore);
            enableButton();
            event.target.disabled = true;
        }

    }

    function enableButton() {
        document.getElementById('continueButton').disabled = false;
    }
</script>


<div class="siteContainer">
    <div class="contentContainer">
        <h4>Please solve the following tasks to test your understanding of the instructions:</h4>

        <h6>Example 1: </h6>
        <p>
            Please solve the following tasks to test your understanding of the instructions:
        </p>

        <div>
            <label for="exam_1">What is your total income after tax in this round?
            </label>
            <input type="text" id="exam_1" onblur="checkResult(event)">
        </div>
    </div>
</div>