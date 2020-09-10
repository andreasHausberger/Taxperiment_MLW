<script>

    $(document).ready(function() {
        $('#continueButton').attr("disabled", "disabled");
    });

    var correctItems = 0;


    function checkResult(event, correctValue, resultFieldId = "", incorrectValueResponseText = "") {
        let inputScore = parseInt(event.target.value);
        let feedbackID = "feedback_" + event.target.id;


        if (inputScore == correctValue) {
            event.target.disabled = true;
            console.log("input value: " + inputScore + " vs. correct value: " + correctValue);
            correctItems += 1;

            if (resultFieldId !== "") {
                document.getElementById(resultFieldId).innerText = "Correct!"
            }
            else {
                alert("Correct!");
            }



            if (correctItems == 3) {
                enableButton();
            }
            event.target.disabled = true;
        }
        else {
            if (resultFieldId !== "" && incorrectValueResponseText !== "") {
                document.getElementById(resultFieldId).innerText = incorrectValueResponseText;
            }
            else {
                alert ("Try again!");
            }
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
            <p class="textSpan">
                You have guaranteed earnings of 1000 ECU and you earn an extra 800 ECU. Your total income before tax is
                1800 ECU. The tax rate is 40% and leads to a tax due of 720 ECU. You pay the full amount of 720 ECU and
                no audit (check) takes place.
            </p>

            <div>
                <label for="exam_1">What is your total income after tax in this round?
                </label>
                <br>
                <input type="text" id="exam_1" onblur="checkResult(event, 1080, 'result-1', 'Incorrect! The total income is 1080 ECU!')">
                <div id="result-1"></div>
            </div>
        </div>
        <div class="example">
            <h3>Example 2: </h3>
            <p class="textSpan">
                You have guaranteed earnings of 1000 ECU and you earn an extra 900 ECU. Your total income before tax is
                1900 ECU. The tax rate is 20% leading to a tax due of 380 ECU. You pay 100 ECU of the required tax and
                no audit (check) takes place.
            </p>

            <div>
                <label for="exam_1">What is your total income after tax in this round?
                </label>
                <br>
                <input type="text" id="exam_1" onblur="checkResult(event, 1800, 'result-2', 'Incorrect! The total income is 1800 ECU!')">
                <div id="result-2"></div>
            </div>
        </div>
        <div class="example">
            <h3>Example 3: </h3>
            <p class="textSpan">
                You have guaranteed earnings of 1000 ECU and you earn an extra 700 ECU. Your total income before tax is
                1700 ECU. The tax rate is 40% and leads to a tax due of 680 ECU. You pay 280 ECU of the required tax.
                An audit (check) takes place, the fine that you are asked to pay is payment + 50%. This means that
                you have to pay the missing 400 ECU, plus a fine of another 200 ECU (50% of the missing amount).
            </p>

            <div>
                <label for="exam_1">What is your total income after tax in this round?
                </label>
                <br>
                <input type="text" id="exam_1" onblur="checkResult(event, 820, 'result-3', 'Incorrect! The total income is 820 ECU!')">
                <div id="result-3"></div>
            </div>
        </div>

    </div>
</div>
