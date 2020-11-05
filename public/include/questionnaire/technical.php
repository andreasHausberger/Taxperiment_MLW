<?php
    $numberOfQuestions = 2;

    if (sizeof($_POST) >= $numberOfQuestions) {
        $tech1 = postParamValue("tech1");
        $tech2 = postParamValue("tech2");
        $trouble = postParamValue("trouble");

        $participant = $_GET["pid"];

        $qb->addString("tech1", $tech1);
        $qb->addString("tech2", $tech2);
        $qb->addString("trouble", $trouble);

        $query = $qb->buildInsert("WHERE pid = $participant", true);

        if ($db->insertQuery($query)) {
            console_log("EXP data inserted successfully!");

            $host = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=9");
        }
    }
?>

<script>
    const numberOfQuestions = 2;
</script>
<script src="/public/js/questionnaire.js"></script>

<form method="post">
    <div class="item">
        <p class="questionText">
        <b>
            1. Which device did you use to answer the questions?
        </b>
        </p>
        <div>
            <?php echo createLikert(4, "tech1", ["Computer", "Laptop", "Phone", "Tablet"]); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText">
        <b>
            2. Which input device did you use to answer the questions?
        </b>
        </p>
        <div>
            <?php echo createLikert(4, "tech2", ["Computer Mouse", "Trackpad", "Touchscreen (Phone, Tablet)", "Stylus Pen (Apple Pencil, Wacom etc.)"]); ?>
        </div>
    </div>

    <div class="item" style="margin-bottom: 16px">
        <p class="questionText">
        <b>
            3. Did you have any technical difficulties? (If yes, please explain in the following field).
        </b>
        </p>
        <div>
            <input type="text" name="trouble">
        </div>
    </div>

    <input id="submitButton" type="submit" value="Finish Questionnaire" disabled="true">
</form>
