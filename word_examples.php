<?php
function example_word($type) {
    $t = strtolower($type);
    $f = function($find) use ($t) {
        return (!(strpos($t, $find) === false));
    };
    $r = function($ret) use ($type){
        if (mb_strtoupper($type[0]) == $type[0]) {
            return ucwords($ret);
        }
        else return $ret;
    };

    if ($f("noun")) {
        if ($f("proper")) {
            return "The Ministry of Defence, Wikipedia, Marmite, France";
        }
        elseif ($f("abstract")) {
            if ($f("plural") || $f("nouns")) {
                return $r("numbers");
            }
            else return $r("science, love");
        }
        elseif ($f("nouns") || $f("plural")) {
            return $r("peanuts, sheep");
        }
        else {
            return $r("bicycle, sock");
        }
    }
    elseif ($f("adverb")) {
        return  $r("quickly, haughtily");
    }
    if ($f("verb")) {
        if ($f("gerund") || $f("ing") || $f("progressive") ||$f("continuous")) {
            return $r("singing, whipping, being");
        }
        elseif ($f("inf") || $f("infinitive")) {
            return $r("sing, whip, be");
        }
        elseif ($f("third") || $f("present")) {
            return $r("strikes, whips, is");
        }
        elseif ($f("past")) {
            if ($f("simple")) {
                return $r("struck, whipped, was");
            }
            elseif ($f("participle")) {
                return $r("stricken, whipped, been");
            }
            elseif ($f("perfect")) {
                return $r("struck, whipped, been");
            }
            else {
                return $r("struck, whipped, was");
            }
        }
        else {
            return $r("sing, whip, be");
        }
    }
    elseif ($f("adjective")) {
        return $r("yellow, excellent");
    }
    elseif ($f("place")) {
        return "Mike's Bar, Scotland";
    }
    elseif ($t == "country") return "South Sudan";
    elseif ($t == "town") return "London, Edinburgh";
    elseif ($t == "name" || $f("person")) {
        return "Gordon Brown";
    }
    elseif ($f("number")) {
        return $r("seven, 42, over 9000");
    }
    elseif ($f("body part")) {
        if ($f("plural") || $f("body parts")) return $r("hands, eyes");
        else return $r("hand, eye");
    }
    elseif ($f("time")) {
        return $r("3AM, The 25th Hour");
    }
    elseif($t === 'colour' || $t === 'color') {
        return $r("red, octarine");
    }
}
?>
