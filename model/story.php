<?php

include_once('db.php');


class NewStoryException extends Exception {}
class StoryException extends Exception {}
class StoryNotFoundException extends StoryException{}
/**
 * A story item.
 */
class Story extends dbItem{
    private static $table = "games";
    public $subbed;
    public static function get_all() {
        $table = Story::$table;
        $results = pg_query("SELECT * FROM $table");
        $list = Story::from_result_list($results, "Story");
        return $list;
    }

    public static function get_by_name($name, $exceptions = true) {
        $name = pg_escape_string($name);
        $table = Story::$table;
        $results = pg_query("SELECT * FROM $table WHERE name='$name' LIMIT 1") or die(mysql_error());

        $list = Story::from_result_list($results, "Story");
        if (!$list[0] && ($exceptions === true)) {
            $n = htmlentities($name);
            throw new StoryNotFoundException("A story with the name <em>$n</em> does not exist.");
        }
        return $list[0];
    }
    public static function get_by_urlname($url) {
        return Story::get_by_name(Story::url_to_name($url));
    }

    public function get_words() {
        $numfields = preg_match_all('|\[(\((.*?)\))?(.*?)\]|', $this->content, $out);
		$words = Array();
		
		array_walk($out[3], function($value) use (&$words) {
			if (trim($value) !== "") {
				$words[] = $value;
			}
		});
        return $words;
    }

    public function sub_words($array) {
        $i=-1;
        $repeats = Array();
        $this->subbed = preg_replace_callback('|\[(\((.*?)\))?(.*?)\]|', function($match) use ($array, &$repeats, &$i) {
            $val = "";
            if (trim($array[$i+1]) === "") {
                $val = htmlspecialchars($match[0]);
            }
            else {
            	$val = htmlspecialchars($array[$i+1]);
            }

            if ($match[1]!=="") {
            	$key = trim($match[1]);
        		if ($repeats[$key] != null) {
        			return "<span class=\"word\"> ".$repeats[$key]."</span>";
        		}
            	else {
            		$i++;
            		$repeats[$key] = $val;
            		return "<span class=\"word\">$val</span>";            	
            	}
            }
            else {
            	$i++;
            	return "<span class=\"word\">$val</span>";
            }

            
        }, htmlspecialchars($this->content));
        $this->subbed = str_replace("\n", "<br />", $this->subbed);
        return $this->subbed;
    }

    public static function post_new($name, $content, $author, $password="") {
        if (strpos($name, "_") !== false) {
            throw new NewStoryException("Underscores are not allowed in story names.");
        }
        $numfields = preg_match_all('|\[(.*?)\]|', $content, $out);
        if ($numfields == 0) {
            throw new NewStoryException("You must include at least one tag in your story.");
        }
        $hash = '';
        if ($password !== "") {
            $hash =  pg_escape_string(sha1(sha1($password).$name));
        }

        $name = pg_escape_string($name);
        $author = pg_escape_string(htmlentities($author));
        $content = pg_escape_string($content);


        $table = Story::$table;
        $str = "INSERT INTO $table (name, content, author, fields, password) VALUES ('$name', '$content', '$author', $numfields, '$hash')";
        $result = pg_query($str) or die(mysql_error());
    }

    public function delete($password) {
        $table = Story::$table;
        $hash = sha1(sha1($password).$this->name);
        $name = pg_escape_string($this->name);
        if ($hash == $this->password) {
            $hash = pg_escape_string($hash);
            $result = pg_query("DELETE FROM $table WHERE name='$name' AND password='$hash'") or die(mysql_error());
            return $result;
        }
        else {
            Throw new StoryException('Incorrect password.');
        }
    }

    public static function name_to_url($name) {
        $n = str_replace(" ", "_", $name);
        $n = urlencode($n);
        return $n;
    }
    public static function url_to_name($url) {
        $n = urldecode($url);
        $n = str_replace("_", " ", $n);
        return $n;
    }

    public function safename() {
        return htmlentities($this->name);
    }
    public function get_url() {
        return Story::name_to_url($this->name);
    }

}
?>
