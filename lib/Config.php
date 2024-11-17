<?php



class Config {



//DB vertapp_reseller

    //Added user vertapp_xmluser with password xml123XML.

    private static function DB() {

        if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost") {

            return "afs";

        } else {

            return "afs";

        }

    }



    private static function USER() {

        if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost") {

            return "root";

        } else {

            return "root";

        }

    }



    private static function PASSWORD() {

        if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost") {

            return '';

        } else {

            return '123';

        }

    }



    private static function HOST() {

        if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost") {

            return "127.0.0.1";

        } else {

            return "localhost";

        }

    }



    public static function &OpenDBConnection() {

       // return new mysqli(Config::HOST(), Config::USER(), Config::PASSWORD(), Config::DB());

    $OpenDB = new mysqli(Config::HOST(), Config::USER(), Config::PASSWORD(), Config::DB());
    return $OpenDB;

    }



    public static function &CreateStatement($mysqli, $query) {

        $stmt = $mysqli->prepare($query);

        return $stmt;

    }



    public static function BaseUrl() {

        return "localhost/atish/";

    }




}

?>