<?php
class Database
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'bookstore');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getMysqli()
    {
        return $this->mysqli;
    }

    // Make executeQuery method public
    public function executeQuery($sql)
    {
        return $this->mysqli->query($sql);
    }

    // INSERT DATA HERE

    public function insert($table, $para = array())
    {
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);

        $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";
        $result = $this->mysqli->query($sql);
        return $result;
    }

    public function select($table, $rows = "*", $where = null, $limit = null, $orderBy = null)
    {
        // print_r($orderBy);

        $sql = "SELECT $rows FROM $table";

        if ($where !== null) {
            $sql .= " WHERE $where";
        }

        if ($limit !== null) {
            $sql .= " LIMIT $limit";
        }

        // if ($orderBy !== null) {
        //     $sql .= " ORDER BY $orderBy";
        // }

        return $this->executeQuery($sql);
    }

// update work
    public function update($tableName, $data, $where)
    {
        $sql = "UPDATE `$tableName` SET ";
        $set = array();

        foreach ($data as $column => $value) {
            $set[] = "`$column` = '" . $this->mysqli->real_escape_string($value) . "'";
        }

        $sql .= implode(', ', $set);
        $sql .= " WHERE $where";

        return $this->executeQuery($sql);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}
