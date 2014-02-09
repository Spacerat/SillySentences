<?php
class db {
    public static function get_connection($url='172.17.42.1',$username='root',$pwd='ktEguYY1ma5Yb5i1', $db='db') {
        $conn = pg_connect("dbname=$db host=$url port=49165 user=root password=$pwd");
        //pg_select_db($db);



        return $conn;
    }


    public static function init() {
        pg_query("DROP TABLE games;");

        pg_query("
        CREATE TABLE games( 
           ID          SERIAL PRIMARY KEY  NOT NULL,
           name        TEXT  UNIQUE  NOT NULL,
           content     TEXT             NOT NULL,
           author      TEXT             NOT NULL,
           fields      INT              NOT NULL,  
           password    TEXT
        );");
    }

}



class dbItem {
    protected $data;

    public function __construct($result) {
        $this->data = $result;
    }
    
    public function __get($name) {
        $d = $this->data;
        if (isset($d->$name)) {
            return ($d->$name);
        }
        else {
            return null;
        }
    }

    protected static function from_result_list($results, $classname) {
        if (!$results){return False;}
        $n = pg_num_rows($results);
        $obj = pg_fetch_object($results);
        $arr = Array();
        while ($obj) {
            $q = new $classname($obj);
            $arr[] = $q;
            $obj = pg_fetch_object($results);
        }
        return $arr;
    }
}
?>
