<?php

/**
 * code.php
 *
 * Here go all the functions.
 */


function console_log($data) {
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

if (!function_exists("loadRoundData")) {
    /**
     * Fetches round data from Database and shuffles it by default.
     * @param bool $paraShuffle: Specifies whether the array should be in random order.
     * @param $paraConnection: Valid mysqli connection.
     * @return array|bool: Returns array with round data if connection succeeds, false if it doesn't.
     */
    function loadRoundData($paraConnection, $paraShuffle = true) {
        console_log('loadRoundData');
        $roundQueryAsc = "SELECT * FROM exp_round";

        $roundsResult = $paraConnection->query($roundQueryAsc);
        global $expRounds, $dataArray;

        if ($roundsResult->num_rows > 0) {
            while ($row = $roundsResult->fetch_assoc()) {
                $expRounds[] = $row;
            }


            if ($paraShuffle)
                shuffle($expRounds);

            return $expRounds;
        }
        else {
            echo "Connection error: " . $paraConnection->error;
        }
        return false;
    }
}

if(!function_exists('getRandomOrder')) {
    function getRandomOrder($paraConnection, $paraExpID) {
        $randomOrderQuery = $paraConnection->prepare('SELECT ero.round_order FROM exp_round_order ero WHERE exp_id = (?)');

        $randomOrderQuery->bind_param('i', $paraExpID);

        if ($randomOrderQuery->execute()) {
            $result = $randomOrderQuery->get_result();

            if ($result->num_rows > 0 ) {
                while ($row = $result->fetch_row()) {
                    return $row[0];
                }
            }
            else {
                return createNewRandomOrder($paraConnection, $paraExpID);
            }
        }
    }
}

function createNewRandomOrder($paraConnection, $paraExpID) {
    $roundArray = range(0, 23);

    shuffle($roundArray);

    $arrayString = json_encode($roundArray);

    $insertRandomOrderQuery = $paraConnection->prepare('INSERT INTO exp_round_order (exp_id, round_order) VALUES (?, ?)');
    $insertRandomOrderQuery->bind_param('is', $paraExpID, $arrayString);

    if ($insertRandomOrderQuery->execute()) {
        return $roundArray;
    }
    return null;

}


if( !function_exists("createRiskAversionRow") ) {
    /**
     * @param $rowName: Row name (used for form handling)
     * @param $probA1: Probability for this field
     * @param $ecuA1: ECU amount for this field
     * @param $probA2: Probability for this field
     * @param $ecuA2: ECU amount for this field
     * @param $probB1: Probability for this field
     * @param $ecuB1: ECU amount for this field
     * @param $probB2: Probability for this field
     * @param $ecuB2: ECU amount for this field
     */
    function createRiskAversionRow($rowName, $probA1, $ecuA1, $probA2, $ecuA2, $probB1, $ecuB1,  $probB2, $ecuB2) {

        echo "
<tr>
                <td>
                    <span> Wahrscheinlichkeit $probA1%, ECU $ecuA1</span> <br>
                    <span> Wahrscheinlichkeit $probA2%, ECU $ecuA2</span>
                </td>
                <td>
                    <input class='riskAversionInput' type=\"radio\" value='A' name=\"$rowName\"> A
                    <input class='riskAversionInput' type=\"radio\" value='B' name=\"$rowName\"> B
                </td>
                <td>
                    <span> Wahrscheinlichkeit $probB1%, ECU $ecuB1</span> <br>
                    <span> Wahrscheinlichkeit $probB2%, ECU $ecuA2</span>
                </td>
            </tr>
";

    }
}

if ( !function_exists("createRiskAversionTask") ) {
    /**
     * @param $taskArray: Array of Tasks, must contain arrays with a format compliant with function createRiskAversionRow
     */
    function createRiskAversionTask($taskArray) {
        echo "
<table class=\"mlwTable riskAversionTable\">
            <thead>
            <tr>
                <td style='text-align: center'>
                    <span style='margin: auto'>Option A</span>
                </td>
                <td>

                </td>
                <td style='text-align: center'>
                    <span style='margin: auto'>Option B</span> 
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

if (!function_exists('getAuditButtons')) {
    function getAuditButtons() {
        echo "<div class=\"buttonContainer\">
                <input type=\"submit\" class=\"formButton\" id=\"complyButton\" value=\"Steuern bezahlen\" >
                <input type=\"submit\" class=\"formButton\" id=\"evadeButton\" value=\"Steuern hinterziehen\" >
            </div>";
    }
}
