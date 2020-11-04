<?php

class RedirectHelper {

    private $database;
    private $queryBuilder;

    public function __construct(Database $database, QueryBuilder $queryBuilder)
    {
        $this->database = $database;
        $this->queryBuilder = $queryBuilder;
    }

    function createUser($paraPostArray) {
        if ($this->verifyPostArray($paraPostArray, 4)) {
            $name = $paraPostArray['sname'];
            $prolificPID = $paraPostArray['prolific_pid'];
            $studyID = $paraPostArray['study_id'];
            $sessionID = $paraPostArray['session_id'];
            return $this->database->insertQuery("INSERT INTO participant (name, prolific_pid, study_id, session_id) VALUES (?, ?, ?, ?)", "ssss", ...[$name, $prolificPID, $studyID, $sessionID]);
        }
        return false;
    }

    function saveRiskSelfAssessment($paraPostArray) {

    }

    function saveRiskQuestionnaire($paraPostArray) {
        if ($this->verifyPostArray($paraPostArray)) {
            $selfRisk = $paraPostArray["risk_self"];
            $subjectID = $paraPostArray["subject_id"];

            if ($selfRisk && $subjectID) {
                return $this->database->insertQuery("INSERT INTO risk_aversion (subject_id, self_risk) VALUES (?, ?)", "ii", ...[$subjectID, $selfRisk]);
            }
            else {
                echo "Error: DB Error!";
            }
        }
        else {
            echo "Error: No PostArray found!";
        }
    }

    private function verifyPostArray($paraPostArray, $paraSize = 0) {
        return !is_null($paraPostArray) && sizeof($paraPostArray) >= $paraSize;
    }

}