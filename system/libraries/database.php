<?php

class database
{
    use session;
    private $host = HOST;

    private $username = USERNAME;

    private $database = DATABASE;

    private $password = PASSWORD;

    public static $db;

    public static $Query;

    public function __construct()
    {
        try
        {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->database;
            self::$db = new PDO($dsn, $this->username, $this->password);
            echo "u lidh";
        } catch (PDOException $e)
        {
            echo "Database Connection error: " . $e->getMessage();
        }
    }

    public static function Query($query, $options = array())
    {
        self::$Query = self::$db->prepare($query);

        if(empty($options))
        {
            return self::$Query->execute();
        }
        else
        {
            return self::$Query->execute($options);
        }
    }

    public static function countData($tableName, $filter = array(), $params = array())
    {
        if(!empty($filter) && !isset($params['join'])) {
            foreach ($filter as $columns => $value) {
                $queryArray[] = "$columns='$value'";
            }

            $querySql = implode(",", $queryArray);

            self::Query("SELECT * FROM " . "$tableName " . "WHERE " . "$querySql");
            self::$Query->execute();

            return self::$Query->rowCount();
        }

        if(empty($filter))
        {
            self::Query("SELECT * FROM " . "$tableName ");
            self::$Query->execute();

            return self::$Query->rowCount();
        }
    }

    public static function fetchData()
    {
        return self::$Query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function singleData()
    {
        return self::$Query->fetch(PDO::FETCH_OBJ);
    }

    public static function getSession($name)
    {
        if(!empty($name))
        {
            return $_SESSION[$name];
        }
    }
}
