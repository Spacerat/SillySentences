<?php
class db {
    public static function get_connection($url='mysql.spacerat.meteornet.net',$username='spacerat',$pwd='abc123', $db='spacerat') {
        $conn = mysql_connect( $url,$username,$pwd);
        mysql_select_db($db);
        return $conn;
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
        $n = mysql_num_rows($results);
        $obj = mysql_fetch_object($results);
        $arr = Array();
        while ($obj) {
            $q = new $classname($obj);
            $arr[] = $q;
            $obj = mysql_fetch_object($results);
        }
        return $arr;
    }
}
?>
