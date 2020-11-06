<?php
$numberOfQuestions = 1;



if(sizeof($_POST) >= $numberOfQuestions) {

    $participant = $_GET['pid'];

    $kno1 = postParamValue("kno1");
    $kno2 = postParamValue("kno2");
    $kno3 = postParamValue("kno3");
    $kno4 = postParamValue("kno4");
    $kno5 = postParamValue("kno5");
    $kno6 = postParamValue("kno6");
    $kno7 = postParamValue("kno7");
    $kno8 = postParamValue("kno8");
    $kno9 = postParamValue("kno9");

    $qb->addString("kno1", $kno1);
    $qb->addString("kno2", $kno2);
    $qb->addString("kno3", $kno3);
    $qb->addString("kno4", $kno4);
    $qb->addString("kno5", $kno5);
    $qb->addString("kno6", $kno6);
    $qb->addString("kno7", $kno7);
    $qb->addString("kno8", $kno8);
    $qb->addString("kno9", $kno9);

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
    <div class="item">
        <p class="questionText">
        <b>
            2. Please try to explain in your own words what an expected value is!
        </b>
        </p>
        <div>
            <input type="text" id="kno_input" name="kno2" style="width: 350px; height: 40px; margin-left: 12px;" onblur="addToArray('kno2')" value=" ">
        </div>
    </div>
    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>