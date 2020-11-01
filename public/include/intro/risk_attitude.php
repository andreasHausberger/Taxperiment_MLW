
<div class="pageContainer">
    <h2>Risk Attitude (self-reported)</h2>

    <p class="tutorialText">
        How do you see yourself: are you generally a person who is fully prepared to take risks or do you try to avoid
        taking risks? <br>
        <b>
            Please tick a box on the scale, where the value 1 means: ‘not at all willing to take risks’ and the value 10
            means: ‘very willing to take risks’.
        </b>

    <form action="/public/templates/redirect_risk_self.php" method="post">
        <input type="hidden" name="page" value=<?php echo $_GET['page'] ?>>
        <input type="hidden" name="condition" value=<?php echo $_GET['condition'] ?>>
        <input type="hidden" name="subject" value=<?php echo $_GET['sname'] ?>>
        <div class="riskSelfContainer">
            <?php echo createLikert(10, "risk_self");  ?>
        </div>
    </form>
    </p>
</div>