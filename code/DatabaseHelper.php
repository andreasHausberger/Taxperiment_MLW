<?php


class DatabaseHelper
{

    private $database;

    /**
     * DatabaseHelper constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function createDownloadButton($paraTableName, $paraFileName, $paraDisplayName) {
        $result = $this->createCSV($paraTableName, $paraFileName, $paraDisplayName, null, null);

        $name = $result["table_name"];
        $filePath = $result["file_path"];

        return "<a href='$filePath'><button class='btn btn-info'>Download $name </button></a>";
    }

    public function createDownloadLink($paraTableName, $paraFileName, $paraDisplayName = null, $paraFields = null, $paraWhereString = null) {
        $result = $this->createCSV($paraTableName, $paraFileName, $paraDisplayName, $paraFields, $paraWhereString);

        $name = $result["table_name"];
        $filePath = $result["file_path"];

        echo "<p> Download Data for Table $name </p> <a href='$filePath'>$paraFileName</a>";

    }

    /**
     * @param $paraTableName
     * @param $paraFileName
     * @param null $paraDisplayName
     * @param null $paraFields
     * @param null $paraWhereString
     */
    public function createCSV($paraTableName, $paraFileName, $paraDisplayName = null, $paraFields = null, $paraWhereString = null) {
        $name = $paraDisplayName ? $paraDisplayName : $paraTableName;
        $filePath = "/tmp/" . $paraFileName . ".csv";


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

        $returnArray = [
            "table_name" => $name,
            "file_path" => $filePath,
            "file_name" => $paraFileName
        ];

        return $returnArray;
    }

    /**
     * @param $paraSQL
     * @param $paraFileName
     * @param $paraHeaders
     * @param null $paraDisplayName
     * @param null $paraFields
     * @param null $paraWhereString
     */
    public function createCustomCSV($paraSQL, $paraFileName, $paraHeaders, $paraDisplayName = null, $paraFields = null, $paraWhereString = null) {
        $name = $paraDisplayName ? $paraDisplayName : "Custom CSV";
        $filePath = "./tmp/" . $paraFileName . ".csv";

        $results = $this->database->selectQuery($paraSQL);

        $dataString = "";

        if ($results && $paraHeaders) {
            $headerString = implode(",", $paraHeaders);

            $dataString .= $headerString;

            foreach ($results as $result) {
                $rowString = "\n" . implode(",", $result);
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

        echo "<p> Download Data  ($name) </p> <a href='$filePath'>$paraFileName</a>";


    }

    public function displayAsTable($paraTableName, $columnArray, $displayColumnArray) {
        $html = "<table id='table_$paraTableName' class='table table-striped expDataTable'>";

        $headerRow = $this->createRow($displayColumnArray, true);

        $html .= $headerRow;

        if(sizeof($columnArray) > 0) {
            $columnString = implode(", ", $columnArray);
        }
        else {
            $columnString = "*";
        }

        $results = $this->database->selectQuery("SELECT $columnString FROM $paraTableName");
        $rowHtml = "";
        foreach ($results as $result) {
            $rowHtml .= $this->createRow($result);
        }

        $html .= $rowHtml;

        $html .= "</table>";

        return $html;
    }



    private function createRow($paraRowdata, $paraIsHeaderRow = false) {
        $html = "<tr>";
        $openTag = $paraIsHeaderRow ? "<th>" : "<td>";
        $closeTag = $paraIsHeaderRow ? "</th>" : "</td>";

        foreach ($paraRowdata as $item) {
            $html .= implode("", [$openTag, $item, $closeTag, "\n"]);
        }

        $html .= "</tr>";

        return $html;
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