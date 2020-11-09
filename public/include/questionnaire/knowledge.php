<?php
$numberOfQuestions = 1;
if(sizeof($_POST) >= $numberOfQuestions) {

    global $db, $qb;

    $participant = $_GET['pid'];
    $kno1 = postParamValue("kno1");

    $qb->addString("kno1", $kno1);


    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if($db->insertQuery($query)) {
        console_log("EXP data inserted successfully!");

        $nextPage = $kno1 == "1" ? 4 : 5;

        $host = $_SERVER['HTTP_HOST'];

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=$nextPage");
    }
}
?>


<script>
    const numberOfQuestions = 1;

    const doesNotKnow = false;

    function conditionalAddToArray(value, caller) {
        addToArray(value);
        addToArray('kno2');
        if (caller == "yes") {
            document.getElementById("kno_input").disabled = false;
        }
        else if (caller == "no") {
            document.getElementById("kno_input").disabled = true;
        }
    }

</script>
<script src="/public/js/questionnaire.js"></script>

<form method="post">
    <div class="item">
        <p class="questionText">
        <b>
            1. Do you know what an expected value is?
        </b>
        </p>
        <div>
            <div class="radioItemFlex" >
                <input type="radio" name="kno1" value="1" onclick="conditionalAddToArray('kno1', 'yes')"}>
                <p> Yes </p>
            </div> <div class="radioItemFlex" >
                <input type="radio" name="kno1" value="2" onclick="conditionalAddToArray('kno1', 'no')"}>
                <p> No </p>
            </div>
        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>