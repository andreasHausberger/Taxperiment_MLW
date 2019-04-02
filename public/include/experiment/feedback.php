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
        $sqlString = "SELECT distinct round, actual_income, net_income, actual_tax, declared_tax, honesty, audit, r.fine_rate FROM audit a join exp_round r on r.id = a.round WHERE pid = $participantID";

        $result = $connection->query($sqlString);

        $rows = $result->fetch_all();
        if (!function_exists(buildResultsRow)) {
            function buildResultsRow($row) {
                $round = $row[0];
                $actualIncome = $row[1]; // earned income
                $netIncome = $row[2];
                $actualTax = $row[3]; // tax due
                $declaredTax = $row[4]; // paid tax
                $honesty = $row[5];
                $auditValue = $row[6];
                $audit = $auditValue  == 1 ? "Audited" : "Not Audited";
                $missingTax = $actualTax - $declaredTax;
                $fine = 0;

                // fine is calculated if participant was audited AND dishonest.
                if ($auditValue == 1 && $honesty == 0) {
                    console_log("determining fine for overview");

                    $fineRate = $row[7];
                    $fine = $actualTax * $fineRate;
                }

                $mtPlusFine = $missingTax + $fine;



                /**
                 * "Round" (passt schon),
                 * "Earned Income" (passt schon),
                 * "Tax Due (in ECU)" muss rein, "Paid Tax" muss rein, dann
                 * "Audit" also not audited/audited,
                 * "Missing Tax Plus Fine" wo einfach der Betrag angegeben wird, also bei keiner Strafe/keinem Audit 0, und am Schluss dann
                 * "Net Income".
                 */
                $htmlTableRow = "
                <tr>
                    <td> $round </td>
                    <td> $actualIncome </td>
                    <td> $actualTax </td>
                    <td> $audit </td>
                    <td> $mtPlusFine </td>
                    <td> $netIncome </td>
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
        <td>Tax Due (in ECU)</td>
        <td>Audit</td>
        <td>Missing Tax Plus Fine</td>
        <td>Net Income</td>
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