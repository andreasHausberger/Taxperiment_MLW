<script>

    $(document).ready(function() {
        $('#continueButton').attr("disabled", "disabled");
    });

    var totalScore = 0;

    function addToScore(event) {
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
        <p>
        <p class="textSpan">

            To earn <b>extra income</b> you will perform an effort task, the slider task, each round.


        </p>
        <p class="textSpan">
            You will see 10 sliders and a timer with 20 seconds to complete the task. Your task is to place each slider <b>exactly in the middle</b> at <b>(50%)</b> of the slider. You will receive <b>100 ECU</b>  for each correctly placed slider.
        </p>
        <p class="textSpan">
            Notice that you will only get the payment if the slider is placed <b>exactly</b> at 50%. If the slider is placed for example at 49%, you will not receive a payment for this, there is no difference between placing the slider at 49% or 0%, both cases are treated as incorrect completion of the task.            </p>
        <p class="textSpan">
            On this page you find an example slider. Place it at 50% and click on 'next'.
        </p>
        <p class="textSpan">
            <b>Note:</b> It is not necessary to pull the slider. You can place it directly by mouse clicks.
        </p>

        </p>
    </div>
    <div class="sliderContainer">
        <form method="post" action=<?php echo $_SERVER['REQUEST_URI']?> >
            <input type="hidden" name="score" id="score" value=0>
            <input class="sliderInput" type="range" name="slider_1" id="slider_1" value="0" min="0" max="100"
                   oninput="output_1.value = slider_1.value" onclick="addToScore(event)">
            <output name="output_1" id="output_1">0</output>
        </form>
    </div>
</div>
