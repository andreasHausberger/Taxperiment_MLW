<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 22.02.19
 * Time: 16:43
 */

// include "../../roundDataLoader.php";


$feedback = $_GET['feedback'];

$experimentId = $_GET['expid'];

if (!isset($participantID)) {
    $participantID = 123; // test data
    echo "No PID was detected - using test data with PID = 123!";
}

if (!isset($experimentId)) {
    echo "No ExperimentID was detected!";
}
else {
    if (!isset($connection)) {
        echo "Could not connect to database!";
    }

    else {

        $dateString = "UPDATE experiment SET finished_experiment = NOW() WHERE id = $experimentId";

        if ($connection->query($dateString)) {
            console_log("Added finished_experiment for $experimentId");
        }

        $sqlString = "SELECT distinct round, actual_income, net_income, actual_tax, declared_tax, honesty, audit, fine FROM audit WHERE pid = $participantID";

        $result = $connection->query($sqlString);

        $rows = $result->fetch_all();
        if (!function_exists(buildResultsRow)) {
            //------------------------------------------------
            function buildResultsRow($row) {
            //------------------------------------------------
                $round = $row[0];
                $actualIncome = $row[1]; // earned income
                $netIncome = $row[2];
                $actualTax = $row[3]; // tax due
                $declaredTax = $row[4]; // paid tax
                $honesty = $row[5];
                $auditValue = $row[6];
                $audit = $auditValue  == 1 ? "Audited" : "Not Audited";
                $missingTax = $actualTax - $declaredTax;
                $fine = $row[7]; //this already includes fine + payback!


                if ($auditValue == 0) {
                    $mtPlusFine = 0;
                }
                else {
                    $mtPlusFine = $missingTax + $fine;
                }



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
                    <td> $declaredTax </td>
                    <td> $audit </td>
                    <td> $fine </td>
                    <td> $netIncome </td>
                </tr>";

                return $htmlTableRow;

            }
        }

    }
}

echo "<h1> Overview </h1>";




    echo "
    <table id=\"overviewTable\">
    <thead>
    <tr>
        <td>Round </td>
        <td>Income</td>
        <td>Tax Due </td>
        <td>Paid Tax </td>
        <td>Audit</td>
        <td>Fine</td>
        <td>Net Income</td>
    </tr>
    </thead>
    <tbody>
    
    ";






    if (isset($rows)) {
        echo "<p> Here is an overview of your performance:   </p>";
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


<p> In the following section you will answer several questions regarding your opinions and impressions of the experiment.
</p>

<a href=<?php echo "../questionnaire/index.php?page=1&expid=$experimentId&pid=" . $participantID; ?>> <input type="button" value="Continue to the questionnaire"></a>