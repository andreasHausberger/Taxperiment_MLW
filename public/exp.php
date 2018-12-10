<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.12.18
 * Time: 09:17
 *
 * $_GET Input:
 *
 * $sname ... Subject Name
 * $condition ... Condition
 * $round ... Current Round (1 ≤ $round ≤ 18)
 * $requiresConfig ... bool, self explanatory
 *
 */


$data = $_GET['data'];
$roundNr = $_GET['roundnr'];

?>

<head>
    <title> Experiment Condition <?php echo $data['condition']; ?></title>
    <link rel="stylesheet" href="../resources/library/mlwebphp_100beta/mlweb.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<script>
    var totalScore = 0;

    function addToScore(event) {
        let inputScore = event.target.value;
        let score = 100 - Math.abs(60 - inputScore);
        totalScore += score;

        document.getElementById('score').setAttribute('value', totalScore);

        console.log("called addToScore with score " + score + " and a totalScore of: " + totalScore);


    }
</script>
<h1> Welcome to the experiment, <?php  echo $data['pname']; ?> </h1>

<div class="sliderTableContainer">
    <form method="post" action=<?php echo "audit.php?data=" . http_build_query($data) . "&roundnr=" . $roundNr; ?> >
        <input type="hidden" name="score" id="score">
        <table class="sliderTable">
            <tbody>
            <tr>
                <td>
                    <input class="sliderInput" type="range"  name="slider_1" id="slider_1" value="50" min="1" max="100" oninput="output_1.value = slider_1.value" onclick="addToScore(event)">
                    <output name="output_1" id="output_1" >50</output>
                </td>
                <td>
                    <input class="sliderInput" type="range" name="slider_2" id="slider_2" value="50" min="1" max="100" oninput="output_2.value = slider_2.value" onclick="addToScore(event)">
                    <output name="output_2" id="output_2">50</output>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="sliderInput" type="range" name="slider_3" id="slider_3" value="50" min="1" max="100" oninput="output_3.value = slider_3.value" onclick="addToScore(event)">
                    <output name="output_3" id="output_3">50</output>
                </td>
                <td>
                    <input class="sliderInput" type="range" name="slider_4" id="slider_4" value="50" min="1" max="100" oninput="output_4.value = slider_4.value" onclick="addToScore(event)">
                    <output name="output_4" id="output_4">50</output>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="sliderInput" type="range" name="slider_5" id="slider_5" value="50" min="1" max="100" oninput="output_5.value = slider_5.value" onclick="addToScore(event)">
                    <output name="output_5" id="output_5">50</output>
                </td>
                <td>
                    <input class="sliderInput" type="range" name="slider_6" id="slider_6" value="50" min="1" max="100" oninput="output_6.value = slider_6.value" onclick="addToScore(event)">
                    <output name="output_6" id="output_6">50</output>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="sliderInput" type="range" name="slider_7" id="slider_7" value="50" min="1" max="100" oninput="output_7.value = slider_7.value" onclick="addToScore(event)">
                    <output name="output_7" id="output_7">50</output>
                </td>
                <td>
                    <input class="sliderInput" type="range" name="slider_8" id="slider_8" value="50" min="1" max="100" oninput="output_8.value = slider_8.value" onclick="addToScore(event)">
                    <output name="output_8" id="output_8">50</output>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="sliderInput" type="range" name="slider_9" id="slider_9" value="50" min="1" max="100" oninput="output_9.value = slider_9.value" onclick="addToScore(event)">
                    <output name="output_9" id="output_9">50</output>
                </td>
                <td>
                    <input class="sliderInput" type="range" name="slider_10" id="slider_10" value="50" min="1" max="100" oninput="output_10.value = slider_10.value" onclick="addToScore(event)">
                    <output name="output_10" id="output_10">50</output>
                </td>
            </tr>
            </tbody>
        </table>

        <input type="submit" class="formButton" name="Weiter" content="Weiter">
    </form>

</div>
</body>




<?php

?>