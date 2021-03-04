<?php


if (!function_exists("getParamValue")) {


    function getParamValue($paramName, $fallback = "") {
        if (isset($_GET[$paramName]) && $_GET[$paramName] != '') {
            return $_GET[$paramName];
        } else {
            return $fallback;
        }
    }
}

if( !function_exists("postParamValue")) {
    function postParamValue($paramName, $fallback = "") {
        if (isset($_POST[$paramName]) && $_POST[$paramName] != '') {
            return addslashes($_POST[$paramName]);
        } else {
            return $fallback;
        }
    }
}

function checkCookieHash() {
    if (isset($_COOKIE['mlhash'])) {
        return password_verify(PASSWORD, $_COOKIE['mlhash']);
    }
    return false;
}

function performLogin($passwordInput) {
    $correctHash = password_hash(PASSWORD, PASSWORD_DEFAULT);

    if (!isset($_COOKIE["mlhash"])) {
        if (password_verify($passwordInput, $correctHash)) {
            setcookie("mlhash", $correctHash);
            return true;
        }
    }
    else
    {
        $cookieHash = $_COOKIE["mlhash"];
        return password_verify($passwordInput, $cookieHash);
    }
    return false;
}

if (!function_exists("saveRiskSelfAssessment")) {
    function saveRiskSelfAssessment($paraPostArray) {

    }
}

if (!function_exists("evaluateRiskTask")) {
    function evaluateRiskTask($paraProbability, $paraSuccessReward, $paraFailureReward) {
        $randomValue = rand(1, 100);

        if ($randomValue <= $paraProbability) {
            return $paraSuccessReward;
        }
        else {
            return $paraFailureReward;
        }
    }
}

if (!function_exists("formatCurrency")) {
    function formatCurrency($currency, $accuracy = 2, $delimiter = ".") {
        $string = number_format($currency, $accuracy, $delimiter, ",");

        return $string;
    }
}

if (!function_exists("isValidValue")) {
    function isValidValue($paraValue) {
        return $paraValue != null && $paraValue != "";
    }
}

function getExperimentIDForParticipantID($paraParticipantID) {
    global $db;

    $expData = $db->selectQuery("SELECT id as experiment_id, participant, exp_condition FROM experiment WHERE participant = ? ", "i", $paraParticipantID);
    $experimentID = $expData["experiment_id"];
    return $experimentID;
}

/**
 * @param array $paraFields
 * @return bool
 */
function validateFields($paraFields) {
    $isComplete = true;
    foreach ($paraFields as $field) {
        $isComplete = $field != null && $field != "";
    }
    return $isComplete;
}

/**
 * @param $paraName: Participant name
 * @param Database|null $paraDB Existing Database, will create new one if none is given.
 * @param QueryBuilder|null $paraQB Existing QueryBuilder, will create new one if none is given.
 */
function createNewParticipant($paraName, $paraDB = null, $paraQB = null) {
    if (!$paraDB) {
        $paraDB = new Database();
    }
    if (!$paraQB) {
        $paraQB = new QueryBuilder("participant");
    }
    $paraQB->addString("name", $paraName);
    $insert = $paraQB->buildInsert("");
    return $paraDB->insertQuery($insert, ['s']);
}

/**
 * @param int $paraParticipantID: Participant ID
 * @param int $paraCondition: Condition, default is 1 //TODO: Wait for Jerome's feedback
 * @param Database|null $paraDB: Existing Database, will create new one if none is given.
 * @param QueryBuilder|null $paraQB: Existing QueryBuilder, will create new one if none is given.
 */
function createNewExperiment($paraParticipantID, $paraCondition = 1, $paraDB = null, $paraQB = null) {
    if (!$paraDB) {
        $paraDB = new Database();
    }
    if (!$paraQB) {
        $paraQB = new QueryBuilder("experiment");
    }
    $experimentID = $paraDB->insertQuery("INSERT INTO experiment (exp_condition, participant) VALUES (?, ?)", "ii", ...[$paraCondition, $paraParticipantID]);

    return $paraDB->insertQuery("UPDATE experiment SET start = NOW() WHERE id = ?", "i", $experimentID);

}

/**
 * Saves Data From Slider Round.
 * @param $paraScore: Slider score (not including any additional points)
 * @param $paraRound: Round index.
 * @param $paraParticipantID: Participant ID.
 * @param null $paraExperimentID: Experiment ID. If none is given, a retrieval via Experiment table is attempted.
 * @return bool|int|mixed: True/false whether operation was successful.
 */
function saveSliderData($paraScore, $paraRound, $paraParticipantID, $paraExperimentID = null) {
    if (!$paraRound || !$paraParticipantID) {
        createWarningHTML("Slider Round Saving Error", "Could not save this slider round: One or more required parameters are missing!");
        return 403;
    }
    global $db;

    if (!$paraExperimentID) {
        $expData = $db->selectQuery("SELECT id as experiment_id, participant, exp_condition FROM experiment WHERE participant = ? ", "i", $paraParticipantID);
        $paraExperimentID = $expData["experiment_id"];
    }

    $existingData = $db->selectQuery("SELECT id FROM audit WHERE exp_id = ? AND round = ?", "ii", ...[$paraExperimentID, $paraRound]);

    $isUpdate = $existingData && sizeof($existingData) > 0;

    $qb = new QueryBuilder("audit");

    $qb->addString("exp_id", $paraExperimentID);
    $qb->addString("pid", $paraParticipantID);
    $qb->addString("actual_income", $paraScore);
    $qb->addString("round", $paraRound);

    if ($isUpdate) {
        $update = $qb->buildInsert("WHERE exp_id = ? AND round = ?", true);
        $db->insertQuery($update, "ii", ...[$paraExperimentID, $paraRound]);
        return 200;
    }
    else {
        $insert = $qb->buildInsert("");
        $db->insertQuery($insert);
        return 201;
    }

}

/**
 * Loads round data for Mouselab table. Independent of condition or round order!
 * @param $paraRound: Round to be loaded
 * @param $paraParticipantID: Participant ID
 * @return array|false: Array of id, tax_rate, audit_probability, fine_rate if successful.
 */
function loadMouselabTableData($paraRound, $paraParticipantID) {
    global $db;
    if (!$paraRound || intval($paraRound) < 1 || intval($paraRound) > 18) {
        echo createWarningHTML("Data Loading Error", "Could not load data: Round is missing or invalid!");
    }

    $expData = $db->selectQuery("SELECT id as experiment_id, participant, exp_condition FROM experiment WHERE participant = ? ", "i", $paraParticipantID);
    $experimentID = $expData["experiment_id"];

    $results = $db->selectQuery("SELECT id, tax_rate, audit_probability, fine_rate FROM exp_round WHERE id = ?", "i", $paraRound);

    $incomeResult = $db->selectQuery("SELECT actual_income FROM audit WHERE round = ? AND exp_id = ?", "ii", ...[$paraRound, $experimentID]);

    $results["income"] = $incomeResult["actual_income"];

    return $results;
}

/**
 * Loads Feedback data from 'audit' table. Uses participantID to get experiment ID.
 * @param $paraRound: Round for which feedback is loaded.
 * @param $paraParticipantID: Participant ID.
 * @return array|false: Array of audit data (excluding 'selected')
 */
function loadFeedbackData($paraRound, $paraParticipantID) {
    global $db;

    if (!$paraRound || intval($paraRound < 1) || intval($paraRound) > 18) {
        echo createWarningHTML("Data Loading Error", "Could not load data: Round is missing or invalid!");
        die();
    }



    $expData = $db->selectQuery("SELECT id as experiment_id, participant, exp_condition FROM experiment WHERE participant = ? ", "i", $paraParticipantID);
    $experimentID = $expData["experiment_id"];

    if (!$experimentID || $paraParticipantID < 0) {
        echo createWarningHTML("Data Loading Error", "Could not load data: Participant ID is missing or unknown!");
        die();
    }

    $results = $db->selectQuery("SELECT 
                                            id, 
                                            exp_id,
                                            round, 
                                            actual_income, 
                                            net_income, 
                                            actual_tax, 
                                            declared_tax, 
                                            honesty, 
                                            audit, 
                                            fine 
                                        FROM 
                                            audit 
                                        WHERE 
                                            exp_id = ? AND
                                             round = ?", "ii", ...[$experimentID, $paraRound]);

    $expRoundResults = $db->selectQuery("SELECT tax_rate, fine_rate FROM exp_round WHERE id = ?", "i", $paraRound);

    $results["tax_rate"] = $expRoundResults["tax_rate"];
    $results["fine_rate"] = $expRoundResults["fine_rate"];

    return $results;
}

/**
 * Saves Audit data.
 * @param $paraRound: Round to save
 * @param $paraParticipantID: Participant ID, is used to get experiment ID
 * @param $paraPostData: Post data that must include: net_income, actual_tax, declared_tax, honesty, audit, fine.
 * @return mixed|bool|int
 */
function saveAuditData($paraRound, $paraParticipantID, $paraPostData) {
    global $db;

    if (!$paraRound || intval($paraRound < 1) || intval($paraRound) > 18) {
        return -1;
    }

    $expData = $db->selectQuery("SELECT id as experiment_id, participant, exp_condition FROM experiment WHERE participant = ? ", "i", $paraParticipantID);
    $experimentID = $expData["experiment_id"];

    $qb = new QueryBuilder('audit');
    $qb->addString('net_income', $paraPostData['net_income']);
    $qb->addString('actual_tax', $paraPostData['actual_tax']);
    $qb->addString('declared_tax', $paraPostData['declared_tax']);
    $qb->addString('honesty', $paraPostData['honesty']);
    $qb->addString('audit', $paraPostData['audit']);
    $qb->addString('fine', $paraPostData['fine']);

    $update = $qb->buildInsert("WHERE exp_id = ? AND round = ?", true);

    $result = $db->insertQuery($update, 'ii', ...[$experimentID, $paraRound]);

    return $result;
}
//(expname, subject, ip, condnum, choice, round, procdata, addvar, adddata)
function saveMlwebData($paraExpName, $paraSubject, $paraIP, $paraCondnum, $paraChoice, $paraRound, $paraProcdata, $paraAddvar = null, $paraAddData = null) {
    global $db;
    $arr = [$paraExpName, $paraSubject, $paraIP, $paraCondnum, $paraChoice, $paraRound, $paraProcdata];
    if (!validateFields($arr)) {
        return -1;
    }
    $experimentName = "condtion_" . $paraCondnum;

    $qb = new QueryBuilder('mlweb');
    $qb->addString('expname', $experimentName);
    $qb->addString('subject', $paraSubject);
    $qb->addString('ip', $paraIP);
    $qb->addString('choice', $paraChoice);
    $qb->addString('round', $paraRound);
    $qb->addString('procdata', $paraProcdata);
    $qb->addString('addvar', $paraAddvar);
    $qb->addString('adddata', $paraAddData);

    $insert = $qb->buildInsert("");
    $db->insertQuery($insert);

    $insertResult = $db->insertQuery("UPDATE mlweb SET submitted = NOW() WHERE subject = ? AND ROUND = ?", 'ii', ...[$paraSubject, $paraRound]);
    return $insertResult;
}