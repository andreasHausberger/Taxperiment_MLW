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

if (!function_exists("createLikert")) {
    function createLikert($number, $name,  $labels = null) {
        $html = "";
        $count = 1;

        while ($count <= $number) {
            if ($labels && sizeof($labels) == $number) {
                $label = $labels[$count - 1];
            }
            else {
                $label = $count;
            }

            $html = $html . " <div class=\"radioItemFlex\" >
                    <input type=\"radio\" name=\"$name\" value=\"$count\" onclick=\"addToArray('$name')\"}>
                    <p> $label </p>
                   </div>";
            $count++;
        }

        return $html;
    }
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
        $randomOrderQuery = $paraConnection->prepare('SELECT ero.round_order, ero.condition_order FROM exp_round_order ero WHERE exp_id = (?)');

        $randomOrderQuery->bind_param('i', $paraExpID);

        if ($randomOrderQuery->execute()) {
            $result = $randomOrderQuery->get_result();

            if ($result->num_rows > 0 ) {
                while ($row = $result->fetch_row()) {
                    return ["roundArray" => $row[0], "conditionArray" => $row[1]];
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

    $conditionArray = array_merge(array_fill(0, 12, 1), array_fill(12, 12, 7));



    shuffle($roundArray);
    shuffle($conditionArray);

    $arrayString = json_encode($roundArray);
    $conditionArrayString = json_encode($conditionArray);

    $insertRandomOrderQuery = $paraConnection->prepare('INSERT INTO exp_round_order (exp_id, round_order, condition_order) VALUES (?, ?, ?)');
    $insertRandomOrderQuery->bind_param('iss', $paraExpID, $arrayString, $conditionArrayString);

    if ($insertRandomOrderQuery->execute()) {
        return ["roundArray" => $roundArray, "conditionArray" => $conditionArray];
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
        $index = substr($rowName, 4, 2);
        echo "
<tr>
                <td>
                $index
                </td>
                <td>
                    <span> Probability $probA1%, ECU $ecuA1</span> <br>
                    <span> Probability $probA2%, ECU $ecuA2</span>
                </td>
                <td>
                    <input class='riskAversionInput' type=\"radio\" value='A' name=\"$rowName\"> A
                    <input class='riskAversionInput' type=\"radio\" value='B' name=\"$rowName\"> B
                </td>
                <td>
                    <span> Probability $ecuB1</span> <br>
                    <span> Probability $probB2%, ECU $ecuA2</span>
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
<table class=\"riskAversionTable\">
            <thead>
            <tr>
                <td style='text-align: center; width: 32px;'>
                #
                </td>
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
    function getAuditButtons($paraShouldBeMirrored = false) {
        if ($paraShouldBeMirrored) {
            echo "<div class=\"buttonContainer\">
                <input type=\"submit\" class=\"formButton\" id=\"evadeButton\" value=\"Don't Pay Tax\" >
                <input type=\"submit\" class=\"formButton\" id=\"complyButton\" value=\"Pay Tax\" >
            </div>";
        }
        else
        {
            echo "<div class=\"buttonContainer\">
                <input type=\"submit\" class=\"formButton\" id=\"complyButton\" value=\"Pay Tax\" >
                <input type=\"submit\" class=\"formButton\" id=\"evadeButton\" value=\"Don't Pay Tax\" >
            </div>";
        }

    }
}

if (!function_exists('createDownloadLink')) {
    function createDownloadLink($paraDBConnection, $paraHeaderQuery, $paraQuery, $paraFilename, $paraText) {
        $headerResults = $paraDBConnection->query($paraHeaderQuery);
        $headers = [];
        if ($headerResults != null) {
            while ($headerRow = $headerResults->fetch_assoc()) {
                $headers[] = $headerRow["Field"];
            }
        }

        $results = $paraDBConnection->query($paraQuery);
        $resultRows = [];

        if ($results != null) {
            while ($row = $results->fetch_row()) {
                $resultRows[] = $row;
            }
        }

        $dataString = implode(";", $headers);

        foreach ($resultRows as $resultRow) {
            $rowString = " \n " . implode(";", $resultRow);
            $dataString .= $rowString;
        }

        if (!$handle = fopen($paraFilename, 'w+')) {
            die("Cannot open file ($paraFilename");
        }

        if (!fwrite($handle, $dataString)) {
            die("Cannot write to file ($paraFilename");
        }

        fclose($handle);

        echo "<p> $paraText </p> <a href='$paraFilename'>$paraFilename</a>";
    }


    if (!function_exists("getParamValue")) {
        function getParamValue($paramName, $fallback = "")
        {
            if (isset($_GET[$paramName]) && $_GET[$paramName] != '') {
                return addslashes($_GET[$paramName]);
            } else {
                return $fallback;
            }
        }
    }


    if (!function_exists("postMaramValue")) {
        function postParamValue($paramName, $fallback = "")
        {
            if (isset($_POST[$paramName]) && $_POST[$paramName] != '') {
                return addslashes($_POST[$paramName]);
            } else {
                return $fallback;
            }
        }
    }
}
