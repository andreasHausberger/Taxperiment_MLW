<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 22.02.19
 * Time: 16:43
 */

// include "../../roundDataLoader.php";

if (!isset($participantID)) {
    $participantID = 123; // test data
    echo "No PID was detected - using test data with PID = 123!";
}
?>

<h1> Overview </h1>

<p> Here goes our overview table -> to be built</p>


<p> In the following segments, you will be asked some questions about your opinions and impressions about the experiment. </p>

<a href=<?php echo "../questionnaire/index.php?page=1&pid=" . $participantID; ?>> <input type="button" value="Continue to Questionnaire!"></a>