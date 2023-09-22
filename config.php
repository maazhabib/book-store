<?php
class Database
{
    // yaha pa ham na phalay ak private function banaya ha
    private $mysqli;


    // yaha pa ham na ak construct fuctino banya ha jia sa hamara code automatoc run ho jata ha hamay run karny ki zarurt ni prti is ka alava
    // ham is ma alag alag variable ma store kr ka call kr saktay tha. 
    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'bookstore');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    // yaha pa ham  na function banaya or is ma ham na return karaya ha data

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
// yaha pa hama na insert ki ka function banaya ha jis sa hamay aagar dousary page pa cahaya ho ga to hamay bus value put kar ka call karana ho ga 
// is ma table cloum ma ham ma array ka data get karay ga or ham is ko query ma bhj da ga or result ma ham na $this->mysqli->query($sql) connection build kr dia ha 

// implode (to concatenate all the elements of an array together in the same order as they are in the array.)
    public function insert($table, $para = array())
    {
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);

        $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";
        $result = $this->mysqli->query($sql);
        return $result;
    }


// yaha pa ham na select function call karya ha is ma ham na data fetch ka lia use karay ga is ma ham na select ka function banaya ha 
// yaha pa ham na where use where id ka lia or limit is lia use kia ha ka ham is ma ham na limit pagination ki k alia use kia ha 

// . ( it is the string concatenation operator.)
// executeQuery (to execute statements that returns tabular data).

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

// is ma ham na ak update ka nam sa function banaya ha is sa ham data update karay ga data ko is ma bhi ham na function bataya
//  ha is ma bhi ham na query bana di ha ta ka dousaray page pa call kr ka value put kr ka data insert kr da ta k ahamara code short ho jay

// real_escape_string  (to escape all special characters for use in an SQL query).
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


// yaha pa ham na inner join ka function banaya ha is ma ham 2 table ko ak sath joar sakty ha ta ka ka ak table 
// ka andr data ha dousary table ka to ham is ko dousaray table sa is ka dousaray table ka data mangva sakay
//  is ma ham na table1 ka nam or table2 ka nam joarn ka lia ha is ka bad ham na condition lagai ha phr column 
// ko bataya ka kon sa column cahaya 

    public function innerJoin($table1, $table2, $onCondition, $columns = '*')
{
    $sql = "SELECT $columns FROM $table1 ";
    $sql .= "INNER JOIN $table2 ON $onCondition";

    return $this->executeQuery($sql);
}


// yaha pa ham na destruct function banaya ha ya is lia banaya ha ka ham jb construct function banatay ha start krna
//  ka lia to destruct function roaknay ka lia 

    public function __destruct()
    {
        $this->mysqli->close();
    }
}


// pagination or search bar ki full detail book-detail.php  pa likhi ha 