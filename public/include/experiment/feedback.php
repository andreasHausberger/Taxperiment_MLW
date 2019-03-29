<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 22.02.19
 * Time: 16:43
 */

// include "../../roundDataLoader.php";


$feedback = $_GET['feedback'];



if (!isset($participantID)) {
    $participantID = 123; // test data
    echo "No PID was detected - using test data with PID = 123!";
}
else {
    if (!isset($connection)) {
        echo "Could not connect to database!";
    }
    else {
        $sqlString = "SELECT round, actual_income, net_income, actual_tax, declared_tax, honesty, audit FROM audit WHERE pid = $participantID";

        $result = $connection->query($sqlString);

        $rows = $result->fetch_all();
        if (!function_exists(buildResultsRow)) {
            function buildResultsRow($row) {
                $round = $row[0];
                $actualIncome = $row[1];
                $netIncome = $row[2];
                $actualTax = $row[3];
                $declaredTax = $row[4];
                $honesty = $row[5] == 1 ? "You were honest" : "You evaded taxes";
                $audit = $row[6] == 1 ? "You were audited" : "You were not audited";


                $htmlTableRow = "
                <tr>
                    <td> $round </td>
                    <td> $actualIncome </td>
                    <td> $netIncome </td>
                    <td> $actualTax </td>
                    <td> $declaredTax </td>
                    <td> $honesty </td>
                    <td> $audit </td>
                </tr>";

                return $htmlTableRow;

            }
        }

    }
}

echo "<h1> Overview </h1>";

if ($feedback == 1 ) {
    echo "
    <table id=\"overviewTable\">
    <thead>
    <tr>
        <td>Round Nr. </td>
        <td>Earned Income</td>
        <td>Net Income</td>
        <td>Actual Tax</td>
        <td>Declared Tax</td>
        <td>Honesty</td>
        <td>Audit</td>
    </tr>
    </thead>
    <tbody>
    
    ";
}





    if (isset($rows) && $feedback == "1") {
        echo "<p> Here is an overview of your results during the 18 rounds of the experiment. </p>";
        foreach ($rows as $row) {
            echo buildResultsRow($row);
        }
    }
    else if (!isset($feedback)) {
        echo "Error: Could not load feedback!";
    }
    else {
        echo "<p> Please follow the instructions below! </p>";
    }

    ?>
    </tbody>
</table>


<p> In the following segments, you will be asked some questions about your opinions and impressions about the experiment. </p>

<a href=<?php echo "../questionnaire/index.php?page=1&pid=" . $participantID; ?>> <input type="button" value="Continue to Questionnaire!"></a>