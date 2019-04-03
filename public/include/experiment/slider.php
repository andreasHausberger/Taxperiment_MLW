
<div class="siteContainer">
    <div class="contentContainer">
        <div class="timerContainer">
            <div class="timerContent">
                <div>
                    <p>
                        Remaining...
                    </p>
                </div>
                <div>
                    <div id="time"></div>
                </div>
            </div>


        </div>
        <div class="sliderTableContainer">
            <form method="post" action= <?php echo "index.php?round=" . $_GET['round'] . "&mode=2&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation"?> >
                <input type="hidden" name="score" id="score">
                <input type="hidden" id="url" value=<?php echo "index.php?round=" . $_GET['round'] . "&mode=2&participant=" . $_GET['sname'] . "&condition=" . $_GET['condition'] ?>>
                <table class="sliderTable">
                    <tbody>
                    <tr >
                        <td style="margin-left: 20px;">
                            <input class="sliderInput" onkeydown="return false;" type="range"  name="slider_1" id="slider_1" value="0" min="0" max="100" oninput="output_1.value = slider_1.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_1" id="output_1" >0</output>
                        </td>
                        <td style="margin-left: 40px;">
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_2" id="slider_2" value="0" min="0" max="100" oninput="output_2.value = slider_2.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_2" id="output_2">0</output>
                        </td>
                    </tr>
                    <tr>
                        <td style="margin-left: 30px;">
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_3" id="slider_3" value="0" min="0" max="100" oninput="output_3.value = slider_3.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_3" id="output_3">0</output>
                        </td>
                        <td>
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_4" id="slider_4" value="0" min="0" max="100" oninput="output_4.value = slider_4.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_4" id="output_4">0</output>
                        </td>
                    </tr>
                    <tr>
                        <td style="margin-left: 10px;">
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_5" id="slider_5" value="0" min="0" max="100" oninput="output_5.value = slider_5.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_5" id="output_5">0</output>
                        </td>
                        <td style="margin-left: 20px;">
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_6" id="slider_6" value="0" min="0" max="100" oninput="output_6.value = slider_6.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_6" id="output_6">0</output>
                        </td>
                    </tr>
                    <tr>
                        <td style="margin-left: 40px;">
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_7" id="slider_7" value="0" min="0" max="100" oninput="output_7.value = slider_7.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_7" id="output_7">0</output>
                        </td>
                        <td style="margin-left: 30px;">
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_8" id="slider_8" value="0" min="0" max="100" oninput="output_8.value = slider_8.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_8" id="output_8">0</output>
                        </td>
                    </tr>
                    <tr>
                        <td style="margin-left: 10px;">
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_9" id="slider_9" value="0" min="0" max="100" oninput="output_9.value = slider_9.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_9" id="output_9">0</output>
                        </td>
                        <td>
                            <input class="sliderInput" onkeydown="return false;" type="range" name="slider_10" id="slider_10" value="0" min="0" max="100" oninput="output_10.value = slider_10.value" onclick="addToScore(event)">
                            <output class="sliderOutput" name="output_10" id="output_10">0</output>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </form>

        </div>
    </div>
</div>

<?php
// Prepare URL from GET elements if set

if (isset($_GET['feedback'])) {
    $feedback = $_GET['feedback'];
    console_log("Feedback is there");
}

if (isset($_GET['order'])) {
    $order = $_GET['order'];
    console_log("Order is there");

}

if (isset($_GET['presentation'])) {
    $presentation = $_GET['presentation'];
    console_log("Presentation is there");

}

$condition = $_GET['condition'];

$nextString = "index.php?round=" . $_GET['round'] . "&mode=2&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation&score=";
?>


<script>

    var totalScore = 0;

    function addToScore(event) {
        let inputScore = event.target.value;
        if (inputScore == 50) {
            let score = 100;
            event.target.disabled = true;
            totalScore += score;
            console.log("called addToScore with score " + score + " and a totalScore of: " + totalScore);

            document.getElementById('score').setAttribute('value', totalScore);
            event.target.disabled = true;
        }

    }

    var time = 20;
    document.getElementById("time").innerHTML = time;

    var countdownTimer = setInterval(function() {
        if (time > 0) {
            document.getElementById("time").innerHTML = --time;
            console.log("timer tick down: " + time);
        }
        else {
            let newURL = "<?php echo $nextString; ?>" + totalScore;
            window.location.href = newURL;
            clearInterval(countdownTimer);
        }
    }, 1000);



</script>

