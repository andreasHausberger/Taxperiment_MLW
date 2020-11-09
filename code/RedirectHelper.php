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
        if ($this->verifyPostArray($paraPostArray)) {
            $selfRisk = $paraPostArray["risk_self"];
            $idResults = $this->database->selectQuery("SELECT p.id FROM participant p WHERE p.name = ?", "s", ...[ $paraPostArray['subject'] ] );
            $subjectID = $idResults["id"];
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

    function saveRiskQuestionnaire($paraPostArray) {
        if ($this->verifyPostArray($paraPostArray, 11) ) {
            $results = [
                $paraPostArray['row_1'],
                $paraPostArray['row_2'],
                $paraPostArray['row_3'],
                $paraPostArray['row_4'],
                $paraPostArray['row_5'],
                $paraPostArray['row_6'],
                $paraPostArray['row_7'],
                $paraPostArray['row_8'],
                $paraPostArray['row_9'],
                $paraPostArray['row_10']
            ];
            $rowNumber = 1;

            foreach ($results as $result) {
                $this->queryBuilder->addString("r" . $rowNumber, $results[$rowNumber - 1]);
                $rowNumber += 1;
            }
            $idResults = $this->database->selectQuery("SELECT p.id FROM participant p WHERE p.name = ?", "s", ...[ $paraPostArray['subject'] ] );
            $subjectID = $idResults["id"];

            $updateQuery = $this->queryBuilder->buildInsert("WHERE subject_id = ?", true);
            return $insertID = $this->database->insertQuery($updateQuery, "i", $subjectID);

        }
        return false;
    }

    function createQuestionnaire($paraID) {
        return $this->database->insertQuery("INSERT INTO questionnaire (pid, created) VALUES (?, NOW())", "s", ...[$paraID]);

    }

    private function verifyPostArray($paraPostArray, $paraSize = 0) {
        return !is_null($paraPostArray) && sizeof($paraPostArray) >= $paraSize;
    }

}