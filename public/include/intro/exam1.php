<script>

    $(document).ready(function() {
        $('#continueButton').attr("disabled", "disabled");
    });

    var correctItems = 0;


    function checkResult(event, correctValue) {
        let inputScore = parseInt(event.target.value);
        let feedbackID = "feedback_" + event.target.id;


        if (inputScore == correctValue) {
            event.target.disabled = true;
            console.log("input value: " + inputScore + " vs. correct value: " + correctValue);
            correctItems += 1;
            alert("Correct!");


            if (correctItems == 3) {
                enableButton();
            }
            event.target.disabled = true;
        }
        else {
            alert ("Try again!");
        }

    }

    function enableButton() {
        document.getElementById('continueButton').disabled = false;
    }
</script>


<div class="siteContainer">
    <div class="contentContainer">
        <h4>Please solve the following tasks to test your understanding of the instructions:</h4>

        <div class="example">
            <h3>Example 1: </h3>
            <p>
                You have guaranteed earnings of 1000 ECU and you earn an extra 800 ECU. Your total income before tax is 1800 ECU. The tax rate is 40% and leads to a tax due of 720 ECU. You pay the full amount of 720 ECU and no audit (check) takes place.
            </p>

            <div>
                <label for="exam_1">What is your total income after tax in this round?
                </label>
                <input type="text" id="exam_1" onblur="checkResult(event, 1080)">
            </div>
        </div>
        <div class="example">
            <h3>Example 2: </h3>
            <p>
                You have guaranteed earnings of 1000 ECU and you earn an extra 900 ECU. Your total income before tax is 1900 ECU. The tax rate is 20% leading to a tax due of 380 ECU. You pay 100 ECU of the required tax and no audit (check) takes place.
            </p>

            <div>
                <label for="exam_1">What is your total income after tax in this round?
                </label>
                <input type="text" id="exam_1" onblur="checkResult(event, 1800)">
            </div>
        </div>
        <div class="example">
            <h3>Example 3: </h3>
            <p>
                You have guaranteed earnings of 1000 ECU and you earn an extra 700 ECU. Your total income before tax is 1700 ECU. The tax rate is 40% and leads to a tax due of 680 ECU. You pay 280 ECU of the required tax. An audit takes place, and you have to pay the missing 400 ECU, plus a fine of another 200 (fine rate of 0.5).
            </p>

            <div>
                <label for="exam_1">What is your total income after tax in this round?
                </label>
                <input type="text" id="exam_1" onblur="checkResult(event, 820)">
            </div>
        </div>

    </div>
</div>