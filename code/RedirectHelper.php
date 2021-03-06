<?php

class RedirectHelper {

    private $database;
    private $queryBuilder;

    public function __construct(Database $database, QueryBuilder $queryBuilder)
    {
        $this->database = $database;
        $this->queryBuilder = $queryBuilder;
    }

    function createUser($paraPostArray, $paraNumberOfRetries = 5) {
        if ($this->verifyPostArray($paraPostArray, 4)) {
            $name = $paraPostArray['sname'];
            $prolificPID = $paraPostArray['prolific_pid'];
            $studyID = $paraPostArray['study_id'];
            $sessionID = $paraPostArray['session_id'];

            $existingUserQuery = "SELECT * FROM participant p WHERE p.name = ?";
            if (($existingUserResult = $this->database->selectQuery($existingUserQuery, "s", $name))) {
                return $existingUserResult["id"];
            }
            else {
                $result =  $this->database->insertQuery("INSERT INTO participant (name, prolific_pid, study_id, session_id) VALUES (?, ?, ?, ?)", "ssss", ...[$name, $prolificPID, $studyID, $sessionID]);
                if (!$result && $paraNumberOfRetries > 0) {
                    $this->createUser($paraPostArray, $paraNumberOfRetries - 1);
                }
                return $result;
            }
        }
        return false;
    }

    function saveRiskSelfAssessment($paraPostArray) {
        if ($this->verifyPostArray($paraPostArray)) {
            $selfRisk = $paraPostArray["risk_self"];
            $idResults = $this->database->selectQuery("SELECT p.id FROM participant p WHERE p.name = ? ORDER BY p.id DESC", "s", ...[ $paraPostArray['sname'] ] );
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
            $idResults = $this->database->selectQuery("SELECT p.id FROM participant p WHERE p.name = ? ORDER BY p.id DESC", "s", ...[ $paraPostArray['sname'] ] );
            $subjectID = $idResults["id"];

            $updateQuery = $this->queryBuilder->buildInsert("WHERE subject_id = ?", true);
            return $insertID = $this->database->insertQuery($updateQuery, "i", $subjectID);

        }
        return false;
    }

    function saveComprehensionTask($paraPostArray) {
        if ($this->verifyPostArray($paraPostArray, 5)) {
            $idResults = $this->database->selectQuery("SELECT p.id FROM participant p WHERE p.name = ? ORDER BY p.id DESC", "s", ...[ $paraPostArray['sname'] ] );
            $subjectID = $idResults["id"];

            $this->queryBuilder->addString("comp1", $paraPostArray["comp1"]);
            $this->queryBuilder->addString("comp2", $paraPostArray["comp2"]);
            $this->queryBuilder->addString("comp3", $paraPostArray["comp3"]);
            $this->queryBuilder->addString("comp4", $paraPostArray["comp4"]);
            $this->queryBuilder->addString("pid", $subjectID);

            $insertQuery = $this->queryBuilder->buildInsert("");
            return $insertID = $this->database->insertQuery($insertQuery);
        }
    }

    function createQuestionnaire($paraID) {
        return $this->database->insertQuery("INSERT INTO questionnaire (pid, created) VALUES (?, NOW())", "s", ...[$paraID]);

    }

    private function verifyPostArray($paraPostArray, $paraSize = 0) {
        return !is_null($paraPostArray) && sizeof($paraPostArray) >= $paraSize;
    }

}