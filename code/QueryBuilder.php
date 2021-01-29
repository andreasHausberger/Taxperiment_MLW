<?php


/**
 * Class QueryBuilder
 * Builds queries from an array of variables.
 */
class QueryBuilder
{
    public function __construct($tableName)
    {
        $this->table = $tableName;
    }

    private $varArray;

    private function cleanup() {
        $this->varArray = [];
    }

    /**
     * Builds and returns a MySQL insert statement. Does not actually perform the statement!
     * @param $whereString 'WHERE' term of the statement
     * @param false $isUpdate Defines whether the statement is a true insert (new data is stored) or an update (existing data is changed)
     * @return false|string Returns the complete statement, or false if the statement could not be built.
     */
    function buildInsert($whereString, $isUpdate = false) {
        if ((!$whereString && $isUpdate) || !$this->table) {
            return false;
        }
        if ($isUpdate) {
            $insertString = "UPDATE $this->table SET ";

            $count = 0;
            foreach ($this->varArray as $key => $value) {

                $string = "$key = '$value'";
                $string .= ($count < sizeof($this->varArray) - 1) ? ", " : " ";
                $insertString .= $string;
                $count++;
            }

            $insertString .= $whereString;
            $this->cleanup();
            return $insertString;
        }
        else {
            $insertString = "INSERT INTO $this->table ";

            $tableString = "";
            $valuesString = "";

            $count = 0;
            foreach ($this->varArray as $key => $value) {
                $string = $key;
                $string .= ($count < sizeof($this->varArray) - 1) ? ", " : " ";
                $tableString .= $string;

                $string = "'$value'";
                $string .= ($count < sizeof($this->varArray) - 1) ? ", " : " ";
                $valuesString .= $string;
                $count++;
            }

            $insertString .= "(" . $tableString . ")";
            $insertString .= " VALUES (" . $valuesString . ")";
            $insertString .= $whereString;

            $this->cleanup();
            return $insertString;
        }
    }

    function addString($name, $var) {
        $this->varArray[$name] = $var;
    }

}