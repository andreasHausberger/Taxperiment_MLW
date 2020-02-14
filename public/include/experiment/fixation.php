
<div class="siteContainer">
    <div class="contentContainer">
        <div class="timerContainer">
            <div class="timerContent">
                <div>
                    <p>
                        Verbleibend...
                    </p>
                </div>
                <div>
                    <div id="time"></div>
                </div>
            </div>


        </div>
        <div class="fixationCrossContainer">
            <div class="innerFixationCrossContainer">
                <img src="/public/img/fixation.png" alt="fixation_cross">
            </div>

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

    var time = 2;
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

