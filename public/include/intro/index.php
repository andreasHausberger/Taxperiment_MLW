<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 09:28
 */

$index = isset($_GET['page']) ? $_GET['page'] : -1;
$condition = isset($_GET['condition']) ? $_GET['condition'] : -1;
$participant = isset($_GET['sname']) ? $_GET['sname'] : "";


$pages = array(
    -1 => "error.html",
    1 => "tut_info.php",
    2 => "tut_agreement.php",
    3 => "tut_incentivization.php",
    4 => "tut_risk_aversion_task.php",
    5 => "tut_explanation_cond_1.php",
    6 => "tut_definitions.php", //this varies depending on the condition, is skipped completely in cond 4
    7 => "tut_explanation_mlw_exam1.php",
    8 => "tut_exam2.php",
    9 => "tut_reminder.php"
);

$page = $pages[$index];

if( !function_exists("createRiskAversionRow") ) {
    function createRiskAversionRow($rowName, $probA1, $ecuA1, $probA2, $ecuA2, $probB1, $ecuB1,  $probB2, $ecuB2) {

        echo "
<tr>
                <td>
                    <span> Probability $probA1%, ECU $ecuA1</span> <br>
                    <span> Probability $probA2%, ECU $ecuA2</span>
                </td>
                <td>
                    <input class='riskAversionInput' type=\"radio\" value='A' name=\"$rowName\"> A
                    <input class='riskAversionInput' type=\"radio\" value='B' name=\"$rowName\"> B
                </td>
                <td>
                    <span> Probability $probB1%, ECU $ecuB1</span> <br>
                    <span> Probability $probB2%, ECU $ecuA2</span>
                </td>
            </tr>
";

    }
}

if ( !function_exists("createRiskAversionTask") ) {
    function createRiskAversionTask($taskArray) {
        echo "
<table class=\"mlwTable\">
            <thead>
            <tr>
                <td>
                    Option A
                </td>
                <td>

                </td>
                <td>
                    Option B
                </td>
            </tr>

            </thead>
            <tbody>
";
        foreach ($taskArray as $item) {
             createRiskAversionRow(
                $item['rowName'],
                $item['probA1'],
                $item['ecuA1'],
                $item['probA2'],
                $item['ecuA2'],
                $item['probB1'],
                $item['ecuB1'],
                $item['probB2'],
                $item['ecuB2']
            );
        }

        echo "
 </tbody>
        </table>
";
    }
}

if ($condition == -1) {
    echo "Something went wrong: Index is " . $index . " and condition is " . $condition;
}

else {

    if ($index == 4 || $index == 7 || $index == 8) {
        //risk aversion has its own Next button (submit, save, & redirect).
        //exams 1 and 2 have tax evade/pay buttons, which work as "Next" Buttons.

        require_once ("../../templates/header.php");

        include($page);

        require_once ("../../templates/footer.php");

    }
    else if ($index == 9) {
        require_once ("../../templates/header.php");

        include($page);
        include("../../templates/redirect.php");

        require_once ("../../templates/footer.php");
    }
    else {
        require_once ("../../templates/header.php");

        include($page);

        include("../../templates/continue.php");

        require_once ("../../templates/footer.php");


    }
}



?>