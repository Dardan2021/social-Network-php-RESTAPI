<?php

class userModel extends Database
{
    public static function insertData($table, $data)
    {
        foreach ($data as $key => $value)
        {
            $value = "'$value'";
            $arrayValue[] = $value;
            $arrayKey[] = $key;
        }

        $dataValues = implode(",", $arrayValue);
        $dataColumns = implode(",", $arrayKey);

        if (self::Query("INSERT INTO " . "$table ($dataColumns) values($dataValues)"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function fetchNrData($tableName)
    {
        return self::countData($tableName);
    }

    public static function fetchAllData($tableName, $filter = array(), $params = array())
    {
        if(!empty($filter) && !isset($params['join']))
        {
            foreach ($filter as $columns => $value)
            {
                $queryArray[] = "$columns='$value'";
            }

            $querySql = implode(",", $queryArray);
            self::Query("SELECT * FROM " . "$tableName " . "WHERE " . "$querySql");

            if(isset($params['fetch']))
            {
                switch($params['fetch'])
                {
                    case 'array':

                        return self::fetchData();

                        break;

                    case 'value':

                        return self::singleData();

                        break;
                }
            }

            return self::fetchData();
        }

        if(isset($params['join']))
        {
            $querySqlJoin = array();
            for ($i = 0; $i < count($params['join']); $i++)
            {
                $querySqlJoin[] = "INNER JOIN " . $params['join'][$i]['table'] . " ON $tableName.". $params['join'][$i]['key']. " = ".$params['join'][$i]['table'].".".$params['join'][$i]['foreignKey'];
            }

            $joinSql = implode(" ", $querySqlJoin);
            self::Query("SELECT * FROM $tableName $joinSql");

            return self::fetchData();
        }

        else if(empty($filter) && empty($params))
        {
            if (self::Query("SELECT * FROM " . "$tableName "))
            {
                return self::fetchData();
            }
        }
    }

    public static function deleteData($tableName, $filter= array())
    {
        if(!empty($filter))
        {
            foreach ($filter as $columns => $value)
            {
                $queryArray[] = "$columns='$value'";
            }

            $querySql = implode(",", $queryArray);

            if(self::Query("DELETE FROM $tableName WHERE $querySql"))
            {
                echo "Data u hoq";
            }
        }
    }

    public static function updateData($tableName, $filter= array(), $updateValues)
    {
        if(!empty($filter) && !empty($updateValues))
        {
            foreach ($filter as $columns => $value)
            {
                $queryArray[] = "$columns='$value'";
            }

            $querySql = implode(",", $queryArray);

            foreach ($updateValues as $columns => $value)
            {
                $queryArrayUpdateValues[] = "$columns='$value'";
            }

            $querySqlUpdateValues = implode(",", $queryArrayUpdateValues);

            if(self::Query("UPDATE $tableName SET $querySqlUpdateValues WHERE $querySql"))
            {
                echo "Data u ndryshua";
            }
        }
        else
        {
            return 0;
        }
    }

    public static function fetchSession()
    {
        return self::getSession('name');
    }
}
?>