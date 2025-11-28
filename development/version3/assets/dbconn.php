<?php

function dbconnect_insert()
{

    // very unsecure shouldn't be stored in open plain text as it poses many security issues should be stored in an external file with no connectivity or set as an environment variable in the webserver software
    $servername ="localhost"; // sets server name
    $dbusername = "rolsa_insert";
    $dbpassword = "Password1G";
    $dbname = "rolsa_tech";


    try{
        $conn=new pdo("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);
        // alternatively we could use mysqli but its depreciated and not considered good practice and dbo will connect to any type of data source from 1 command set so if we migrated database systems it would be easy to change
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // sets error modes
        return $conn;
    }
    catch(PDOException $e){ // catch any errors
        error_log("database error: ".$e->getMessage()); // logs error
        throw $e;// outputs the error
    }

}

function dbconnect_select(){
    // very unsecure shouldn't be stored in open plain text as it poses many security issues should be stored in an external file with no connectivity or set as an environment variable in the webserver software
    $servername ="localhost"; // sets server name
    $dbusername = "rolsa_select";
    $dbpassword = "Password1G";
    $dbname = "rolsa_tech";


    try{
        $conn=new pdo("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);
        // alternatively we could use mysqli but its depreciated and not considered good practice and dbo will connect to any type of data source from 1 command set so if we migrated database systems it would be easy to change
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // sets error modes
        return $conn;
    }
    catch(PDOException $e){ // catch any errors
        error_log("database error: ".$e->getMessage()); // logs error
        throw $e;// outputs the error
    }

}

function dbconnect_delete(){
    // very unsecure shouldn't be stored in open plain text as it poses many security issues should be stored in an external file with no connectivity or set as an environment variable in the webserver software
    $servername ="localhost"; // sets server name
    $dbusername = "rolsa_delete";
    $dbpassword = "Password1G";
    $dbname = "rolsa_tech";


    try{
        $conn=new pdo("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);
        // alternatively we could use mysqli but its depreciated and not considered good practice and dbo will connect to any type of data source from 1 command set so if we migrated database systems it would be easy to change
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // sets error modes
        return $conn;
    }
    catch(PDOException $e){ // catch any errors
        error_log("database error: ".$e->getMessage()); // logs error
        throw $e;// outputs the error
    }

}

function dbconnect_update(){
    // very unsecure shouldn't be stored in open plain text as it poses many security issues should be stored in an external file with no connectivity or set as an environment variable in the webserver software
    $servername ="localhost"; // sets server name
    $dbusername = "rolsa_update";
    $dbpassword = "Password1G";
    $dbname = "rolsa_tech";


    try{
        $conn=new pdo("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);
        // alternatively we could use mysqli but its depreciated and not considered good practice and dbo will connect to any type of data source from 1 command set so if we migrated database systems it would be easy to change
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // sets error modes
        return $conn;
    }
    catch(PDOException $e){ // catch any errors
        error_log("database error: ".$e->getMessage()); // logs error
        throw $e;// outputs the error
    }
}
