<?php


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


    function buildInsert($whereString, $isUpdate = false) {
        if (!$whereString || !$this->table) {
            return false;
        }
        if ($isUpdate) {
            $insertString = "UPDATE $this->table SET ";
        }
        else {
            $insertString = "INSERT INTO $this->table SET ";
        }
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

    function addString($name, $var) {
        $this->varArray[$name] = $var;
    }

}