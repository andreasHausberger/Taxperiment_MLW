<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 14:14
 */

if (sizeof($_POST) > 0) {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];

    $participant = $_GET["sname"];


}

?>

<h1>Numeracy</h1>

<form method="post">
    <div class="item">
        <p class="questionText"> 1. How good are you at working with fractions? (1 = not good at all to 7 = extremely good)</p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "num1"); ?>
        </div>
    </div>
</form>
