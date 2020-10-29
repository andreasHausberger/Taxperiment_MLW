<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/code/code.php');

class Database {

    public $connection;

    public function __construct() {
        if (!$this->connection || !$this->connection->client_info) {
            $this->connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
        }    }

    private function open() {
        if (!$this->connection || !$this->connection->client_info) {
            $this->connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
        }
    }

    private function close() {
        $this->connection->close();
    }

    private function displayError($error, $errorQuery) {
        echo "Could not complete operation! <br>";
        echo "Query: " . $errorQuery . " <br>";
        echo "Error: " . $error . " <br>";
    }

    public function selectQuery($query, $paramTypes = null, ...$paramVars) {
        $this->open();

        $results = [];

        if ($paramTypes && $paramVars) {
            $preparedQuery = $this->connection->prepare($query);
            $preparedQuery->bind_param($paramTypes, ...$paramVars);
            if ($preparedQuery->execute()) {
                $results = $preparedQuery->get_result()->fetch_assoc();
            }
            else {
                $this->$this->displayError($preparedQuery->error, $query);
            }
        }
        else {
            $dbResult = $this->connection->query($query);
            if (!$dbResult) {
                $this->displayError($this->connection->error, $query);
            }
            while ($row = $dbResult->fetch_assoc()) {
                $results[] = $row;
            }
        }

        $this->close();

        if ($results) {
            return $results;
        }
        return false;

    }

    public function insertQuery($query, $paramTypes = null, ...$paramVars) {
        $this->open();

        $insertID = null;

        if ($paramTypes != null && $paramVars != null) {
            $preparedQuery = $this->connection->prepare($query);
            $preparedQuery->bind_param($paramTypes, ...$paramVars);

            if($preparedQuery->execute()) {
                $insertID = $preparedQuery->insert_id;


                return $insertID;
            }
            else {
                $this->displayError($preparedQuery->error, $query);
            }
        }
        else {
            if($this->connection->query($query)) {
                $this->close();
                $insertID = $this->connection->insert_id;
                if (!$insertID) {
                    return true;
                }
                return $insertID;
            }
            else {
                $this->displayError($this->connection->error, $query);
            }
        }

        $this->close();
        $this->displayError("Could not complete insert or update: No rows affected!", $query);
        return false;
    }

}