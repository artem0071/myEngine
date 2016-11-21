<?php

/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 20.11.16
 * Time: 18:41
 */
class DB
{
    public $HOST = HOST;
    public $USER = USER;
    public $PASS = PASS;
    public $DB = DB;
    
    function connectDB(){
        
        $CONN = new mysqli(HOST, USER, PASS, DB);
        
        if ($CONN->connect_errno) return false;
        $CONN->set_charset("utf8");
        
        return $CONN;
    }
    
    public static function query($query){
        
        $result = self::connectDB()->query($query);
        if ($result) return $result;
    }

    public static function getResult($query){

        $result = self::query($query);
        $arr = array();

        while ($row = $result->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;
    }

    public static function getResultNumRows($query){

        return mysqli_num_rows(self::query($query));

    }

    public static function insertDB($table,$rows = [],$args=[]){

        $rows = implode("`,`", $rows);
        $args = implode("','", $args);

        if (self::query("INSERT INTO `$table`(`".$rows."`) VALUES ('".$args."')")) return true;
        else return false;
    }

    public static function updateDB($table, $args, $cond){

        $res = array_map(function ($k,$v){return "`$k` = '$v'";}, array_keys($args), $args );
        $res = implode(',', $res);

        $cond = array_map(function ($k,$v){return "`$k` = '$v'";}, array_keys($cond), $cond );
        $cond = implode(',', $cond);
        
        if (self::query("UPDATE `$table` SET $res WHERE $cond")) return true;
        else return false;
    }

    public static function deleteDB($table, $cond){

        if (self::query("DELETE FROM `$table` WHERE $cond")) return true;
        else return false;
        
    }
    
}