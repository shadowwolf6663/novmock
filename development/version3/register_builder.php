<?php //this opens the php code section
session_start();

require_once "assets/dbconn.php";
require_once "assets/common.php";

echo "<!DOCTYPE html>";  // desired tag to declare what type of page it is

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $_SESSION["strength"] = 0; // default value
        $_SESSION["password"] = $_POST["password"]; // setting a session value from inputs
        echo num_check(); // calls function and echos value returned to screen
        echo len_check(); // calls function and echos value returned to screen
        echo lower_check(); // calls function and echos value returned to screen
        echo upper_check(); // calls function and echos value returned to screen
        echo special_check(); // calls function and echos value returned to screen
        echo first_special_check(); // calls function and echos value returned to screen
        echo last_special_check(); // calls function and echos value returned to screen
        echo common_check(); // calls function and echos value returned to screen
        echo first_num_check(); // calls function and echos value returned to screen
        echo strength_check(); // calls function and echos value returned to screen
        if ($_SESSION["strength"] >= 7){
            new_builder(dbconnect_insert(), $_POST);
            $_SESSION["usermessage"]="SUCCESS: builder created!";
            builderauditor(dbconnect_insert(),getnewbuilderid(dbconnect_select(),$_POST["username"]),"reg","created new builder ");
            echo user_message();
        }else{
            $_SESSION["usermessage"]="Failed: password must be a strength of at least 7";
            echo user_message();
        }
        unset($_SESSION["strength"]); // unsets variable

    } catch (Exception $e){

        $_SESSION["usermessage"]="ERROR: Could not create builder: ".$e->getMessage();
        throw $e;
    }

}

echo "<html>";  // opening html
echo "<head>";  // opening head

echo "<title>rolsa tech</title>";  // creating title
echo "<link rel='stylesheet' type='text/css' href='css\styles.css'>";// getting css formatting for website from external

echo "</head>";
echo "<body>"; // opening body


echo "<div class ='container'>"; // class container to give all items a default to reduce need for styling later
require_once "assets/topbar.php"; // presenting header
require_once "assets/nav.php";// presenting navigation bar

echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting
echo "<br>";
echo "<br>";
echo "<form method='post' action=''>";
echo "<input type= 'text' name ='username' placeholder='username'>";
echo "<br>";
echo "<input type= 'password' name ='password' placeholder='password'>";
echo "<br>";
echo "<input type= 'submit' value='register' id='submit'>";
echo "</form>";


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>
