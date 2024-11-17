<?php

class Utils {

    public static function s2p($input) {
        $arr = explode("/", $input);
        return implode("_", $arr);
    }

    public static function p2s($input) {
        $arr = explode("_", $input);
        return implode("/", $arr);
    }

    public static function page_size() {
        return 3;
    }

    public static function rel_time($from, $to = null) {
        $to = (($to === null) ? (time()) : ($to));
        $to = ((is_int($to)) ? ($to) : (strtotime($to)));
        $from = ((is_int($from)) ? ($from) : (strtotime($from)));

        $units = array
            (
            "year" => 29030400, // seconds in a year   (12 months)
            "month" => 2419200, // seconds in a month  (4 weeks)
            "week" => 604800, // seconds in a week   (7 days)
            "day" => 86400, // seconds in a day    (24 hours)
            "hour" => 3600, // seconds in an hour  (60 minutes)
            "minute" => 60,
            "second" => 1
        );

        $diff = abs($from - $to);
        $suffix = (($from > $to) ? ("from now") : (" ago"));

        foreach ($units as $unit => $mult)
            if ($diff >= $mult) {

                if ($unit != "second") {
                    $and = (($mult != 1) ? ("") : ("and "));
                    $output .= ", " . $and . intval($diff / $mult) . " " . $unit . ((intval($diff / $mult) == 1) ? ("") : ("s"));
                    $diff -= intval($diff / $mult) * $mult;
                } else {
                    
                }
            }
        $output .= " " . $suffix;
        $output = substr($output, strlen(", "));
        if (trim($output) == "ago")
            $output = "now";
        return $output;
    }

    public static function GetMMDDONLY($dt) {
        $date = substr($dt, 0, 11);
        $dtArr = explode("-", $date);
        $ex = date("M j", mktime(0, 0, 0, $dtArr[1], $dtArr[2]));
        return $ex;
    }

    public static function HasElements($arr) {
        return count($arr) != 0;
    }

    public static function IsValidExtensionForImage($input) {
        if ($input == "image/jpeg" || $input == "image/pjpeg")
            return true;
        else
            return false;
    }

    public static function mmddyyyy_to_yyyymmdd($dt) {
        $sep = "-";
        if (strpos($dt, "/") > 0)
            $sep = "/";
        $index1 = strpos($dt, $sep);
        $index2 = strpos($dt, $sep, $index1 + 1);
        $mm = substr($dt, 0, $index1);
        $dd = substr($dt, $index1 + 1, $index2 - $index1 - 1);
        $yyyy = substr($dt, $index2 + 1);
        return $yyyy . $sep . $mm . $sep . $dd;
    }

//###########################################################

    public static function yyyymmdd_to_mmddyyyy($dt) {
        $sep = "-";
        if (strpos($dt, "/") > 0)
            $sep = "/";
        $index1 = strpos($dt, $sep);
        $index2 = strpos($dt, $sep, $index1 + 1);
        $yyyy = substr($dt, 0, $index1);
        $mm = substr($dt, $index1 + 1, $index2 - $index1 - 1);
        $dd = substr($dt, $index2 + 1);
        return $mm . $sep . $dd . $sep . $yyyy;
    }

//###########################################################

    public static function yyyymmdd_to_ddmmyyyy($dt) {
        $sep = "-";
        if (strpos($dt, "/") > 0)
            $sep = "/";
        $index1 = strpos($dt, $sep);
        $index2 = strpos($dt, $sep, $index1 + 1);
        $yyyy = substr($dt, 0, $index1);
        $mm = substr($dt, $index1 + 1, $index2 - $index1 - 1);
        $dd = substr($dt, $index2 + 1);
        return $dd . $sep . $mm . $sep . $yyyy;
    }

//###########################################################

    public static function ddmmyyyy_to_yyyymmdd($dt) {
        $sep = "-";
        if (strpos($dt, "/") > 0)
            $sep = "/";
        $index1 = strpos($dt, $sep);
        $index2 = strpos($dt, $sep, $index1 + 1);
        $dd = substr($dt, $index2 + 1);
        $mm = substr($dt, $index1 + 1, $index2 - $index1 - 1);
        $yyyy = substr($dt, 0, $index1);
        return $yyyy . $sep . $mm . $sep . $dd;
    }

//###########################################################

    public static function IsEmpty($err) {
        return count($err) == 0;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public static function IsGet() {
        return $_SERVER['REQUEST_METHOD'] == "GET";
    }

//############################################

    public static function IsPost() {
        return $_SERVER['REQUEST_METHOD'] == "POST";
    }

//############################################

    public static function getvarname(&$var) {
        $ret = '';
        $tmp = $var;
        $var = md5(uniqid(rand(), TRUE));

        $key = array_keys($GLOBALS);
        foreach ($key as $k)
            if ($GLOBALS[$k] === $var) {
                $ret = $k;
                break;
            }

        $var = $tmp;
        return $ret;
    }

//////////////////////////////////////////////////////////////////////

    public static function POPULATE(&$obj, &$arr) {
        // print_r($obj);
        // print_r($arr);

        $metaobj = new ReflectionObject($obj);
        $classname = $metaobj->getName();
        $c = new ReflectionClass($classname);

        $metaobj2 = new ReflectionObject($arr);
        $classname2 = $metaobj2->getName();
        $c2 = new ReflectionClass($classname2);



        foreach ($metaobj2->getProperties() as $p) {

            //echo $metaobj2->getProperty($p->getName());
            $pname = $p->getName();
            $x = $metaobj2->getProperty($pname)->getValue($arr);
            if (isset($x)) {
                $c->getProperty($p->getName())->setValue($obj, $x);
            }
        }
        //return $p;
    }

////////////////////////////////////////
    public static function POPULATE_POST(&$obj) {
        $metaobj = new ReflectionObject($obj);
        $classname = $metaobj->getName();
        $c = new ReflectionClass($classname);
        foreach ($c->getProperties() as $p) {
            if ($p->getName() == "errors" || $p->getName() == "_page_size") {
                continue;
            }
            if (isset($_POST[$p->getName()])) {
                $c->getProperty($p->getName())->setValue($obj, ($_POST[$p->getName()]));
            }
        }
        //return $p;
    }
public static function POPULATE_GET(&$obj) {
        $metaobj = new ReflectionObject($obj);
        $classname = $metaobj->getName();
        $c = new ReflectionClass($classname);
        foreach ($c->getProperties() as $p) {
            if ($p->getName() == "errors" || $p->getName() == "_page_size") {
                continue;
            }
            if (isset($_GET[$p->getName()])) {
                $c->getProperty($p->getName())->setValue($obj, ($_GET[$p->getName()]));
            }
        }
        //return $p;
    }

////////////////////////////////////////

    public static function COPY_ROW_TO_OBJ(&$obj, &$row) {
        $metaobj = new ReflectionObject($obj);
        $classname = $metaobj->getName();
        $c = new ReflectionClass($classname);
        foreach ($c->getProperties() as $p) {
            if ($p->getName() == "errors" || $p->getName() == "_page_size") {
                continue;
            }
            $zz = $p->getName();
            $v = $c->getProperty($p->getName())->getValue($row);
            $c->getProperty($p->getName())->setValue($obj, $v);
        }
    }

////////////////////////////////////////

    public static function ARRAY_TO_CSV($arr) {
        return join(",", $arr);
    }

    public static function CSV_TO_ARRAY($csv) {
        $x = array();
        if (strlen($csv) == 0)
            return $x;
        $ele = explode(",", $csv);
        foreach ($ele as $e)
            $x[] = $e;
        return $x;
    }

    public static function ARRAY_TO_PIPE($arr) {
        return join("|", $arr);
    }

    public static function PIPE_TO_ARRAY($csv) {
        $x = array();
        if (strlen($csv) == 0)
            return $x;
        $ele = explode("|", $csv);
        foreach ($ele as $e)
            $x[] = $e;
        return $x;
    }

///////////////////////////////////////////////////////////////////

    public static function DateOnly($dt) {
        $date = substr($dt, 0, 10);
        return $date;
    }

    ///////////////////////////////////////////////////////////////////

    public static function TimeOnly($dt) {
        $date = substr($dt, 10, 9);
        return $date;
    }

//#####################
    public static function delete_modeldimg($path, $id) {
        if (file_exists("resources/modelimgs/$path/{$id}.png")) {
            unlink("resources/modelimgs/$path/{$id}.png");
        }
    }

//Fn

    public static function messagepage($message, $url, $urltext) {
        header("location:message.php?message={$message}&url={$url}&urltext={$urltext}");
    }

    public static function IsUserLoggedIn() {
        if (!isset($_SESSION['login']) ) {
            Utils::messagepage("Sorry, you are not logged in", "login.php", "Login or Register");
        }
    }
     public static function IsAdminLoggedIn() {
        if (isset($_SESSION['login'])) {
            Utils::messagepage("Access Restricted", "index.php", "Back");
        }
        if ($_SESSION['login']->loginid!="admin") {
            Utils::messagepage("Access Restricted", "index.php", "Back");
        }

    }

//Fn
}
?>