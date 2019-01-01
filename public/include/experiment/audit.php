<div>
    <div>
        <h1> Audit with most recent score: <?php echo $mostRecentScore; ?> </h1>
    </div>
</div>

<?php var_dump($expRounds[$_GET['round'] - 1]); ?>


<iframe  style="width: 500px;" src="/resources/templates/presentation1.php?score= <?php

$round = $expRounds[$_GET['round'] - 1];

echo $mostRecentScore . "&taxRate=" . $round["tax_rate"] . "&auditProbability=" . $round["audit_probability"] . "&fineRate=" . $round["fine_rate"];
?>" + "&" frameborder="0"></iframe>