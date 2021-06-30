<?php
require_once("resources/config.php");
require_once ("code/code.php");
require_once("public/templates/header.php");

echo "<h1> Test </h1>";

$page = postParamValue("exp_page");
$user = postParamValue("username");
$round = postParamValue("round");

?>


<form action="external_test.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo $user?>">

    <label for="round">Round:</label>
    <input type="text" name="round" value="<?php echo $round?>">

    <label for="round">Page:</label>
    <select name="exp_page">
        <option value="slider">Slider</option>
        <option value="audit">Audit</option>
        <option value="feedback">Feedback</option>
    </select>

    <input type="submit">
    
</form>

<?php
if ($page != "" && $user != "" && $round != "") {
    $server = $_SERVER["HTTP_ORIGIN"];
    echo "<iframe style='width: 800px; height: 800px' src=\"$server/external/index.php?page=$page&i=$user&round=$round\" frameborder=\"0\"></iframe>";
}
else {
    echo "Fill out form to start!";
}

?>




<?php require_once("public/templates/footer.php"); ?>
