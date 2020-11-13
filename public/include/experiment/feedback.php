<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 22.02.19
 * Time: 16:43
 */

// include "../../roundDataLoader.php";

require_once ($_SERVER['DOCUMENT_ROOT'] . "/code/Database.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/code/QueryBuilder.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/resources/code/code.php");

$db = new Database();


$feedback = $_GET['feedback'];

$experimentId = $_GET['expid'];

if (!isset($participantID)) {
    $participantID = 1; // test data
    echo "No PID was detected - using test data with PID = 1!";
}

if (!isset($experimentId)) {
    echo "No ExperimentID was detected!";
}
else {

    $dateQuery = "UPDATE experiment SET finished_experiment = NOW() WHERE id = ?";

    if ($db->insertQuery($dateQuery, "i", ...[$experimentId])) {
        console_log("Added finished_experiment for $experimentId");
    }



    $auditQuery = "SELECT round, actual_income, net_income, actual_tax, declared_tax, honesty, audit, fine FROM audit WHERE pid = $participantID AND exp_id = $experimentId";

    $result = $db->selectQuery($auditQuery);

    $rows = $result;

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
        echo "<p> Here is an overview of the tax rounds and whether you were audited:   </p>";
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


<p> In the following section you will be asked to answer a number of questions about the task and your own opinions.
</p>

<a href=<?php echo "../questionnaire/index.php?action=create_questionnaire&page=1&expid=$experimentId&pid=" . $participantID; ?>> <input type="button" value="Continue to the questionnaire"></a>