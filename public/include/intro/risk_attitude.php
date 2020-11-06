
<div class="pageContainer">
    <p class="tutorialText">
        How do you see yourself: are you generally a person who is fully prepared to take risks or do you try to avoid
        taking risks? <br>
        <b>
            Please tick a box on the scale, where the value 1 means: ‘not at all willing to take risks’ and the value 10
            means: ‘very willing to take risks’.
        </b>

    <form action="/public/include/intro/index.php?action=save_risk_self&condition=<?php echo $_GET['condition'] ?>&sname=<?php echo $participant?>&prolificPID=<?php echo $prolificPID?>&studyID=<?php echo $studyID?>&sessionID=<?php echo $sessionID?>&page=5" method="post">
        <input type="hidden" name="page" value=<?php echo $_GET['page'] ?>>
        <input type="hidden" name="condition" value=<?php echo $_GET['condition'] ?>>
        <input type="hidden" name="subject" value=<?php echo $_GET['sname'] ?>>
        <div class="riskSelfContainer">
            <?php echo createLikert(10, "risk_self");  ?>
        </div>
        <input type="submit" value="Next">
    </form>
    </p>
</div>
