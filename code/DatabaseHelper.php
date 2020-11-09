<?php


class DatabaseHelper
{

    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function createCSV($paraTableName, $paraFileName, $paraDisplayName = null, $paraFields = null, $paraWhereString = null) {
        $name = $paraDisplayName ? $paraDisplayName : $paraTableName;
        $filePath = "./tmp/" . $paraFileName . ".csv";


        $headers = $this->getHeaders($paraTableName);

        $results = $this->getData($paraTableName, $paraFields, $paraWhereString);
        $dataString = "";

        if ($results && $headers) {

            $dataString .= implode(",", $headers);

            foreach($results as $result) {
                $rowString = " \n" . implode(",", $result);
                $dataString .= $rowString;
            }
        }

        if (!$handle = fopen($filePath, 'w+')) {
            die("Cannot open file ($filePath)");
        }

        if (!fwrite($handle, $dataString)) {
            die("Cannot write to file ($filePath)");
        }
        fclose($handle);

        echo "<p> Download Data for Table $name </p> <a href='$filePath'>$paraFileName</a>";

    }

    public function displayAsTable($paraTableName) {

    }

    private function getHeaders($paraTableName) {
        $query = "SHOW columns FROM $paraTableName";
        $results = $this->database->selectQuery($query);

        $headers = [];
        foreach ($results as $result) {
            $headers[] = $result["Field"];
        }

        return $headers;
    }

    private function getData($paraTableName, $paraFieldString = null, $paraWhereString = null) {
        $fields = $paraFieldString ? $paraFieldString : "*";

        $query = "SELECT $fields FROM $paraTableName";
        if ($paraWhereString) {
            $query .= $paraWhereString;
        }

        return $this->database->selectQuery($query);
    }

}