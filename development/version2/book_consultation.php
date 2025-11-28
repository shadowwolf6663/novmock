<?php //this opens the php code section
session_start(); // start session

require_once "assets/dbconn.php"; // connects to another file
require_once "assets/common.php"; // connects to another file

echo "<!DOCTYPE html>";  // desired tag to declare what type of page it is

echo "<html>";  // opening html
echo "<head>";  // opening head

echo "<title>page title</title>";  // creating title
echo "<link rel='stylesheet' type='text/css' href='css\styles.css'>";// getting css formatting for website from external

echo "</head>";
echo "<body>"; // opening body


echo "<div class ='container'>"; // class container to give all items a default to reduce need for styling later
require_once "assets/topbar.php"; // presenting header
require_once "assets/nav.php";// presenting navigation bar

echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting

if (!isset($_SESSION["user"])) {// checks if a user is logged in to reduce attack vectors
    $_SESSION["usermessage"] = "You must be logged in to access this page!";
    header("Location: index.php");
    exit;
}
elseif ($_SERVER["REQUEST_METHOD"] === "POST") {// checks request method

    $tmp=$_POST["consultation_date"]. ' '.$_POST["consultation_time"];
    $epoch = strtotime($tmp);
    if(create_consultation(dbconnect_insert(), $epoch)){

        $_SESSION["usermessage"] = "booked consultation";// assigning message
        header("Location: view_consultations.php");
        exit;

    }else{

        $_SESSION["usermessage"] = "failed to create consultation";// assigning message

    }

    echo user_message();// echo message to screen

}


echo "<form method='post' action=''>";// opens a form
$consultants=consultant_getter(dbconnect_select());
echo "<label for ='consultant_time'>consultation time: </labelfor></label>";
echo "<input type= 'time' name ='consultation_time'>";// creates input box
echo "<br>";// breaks to next line
echo "<label for ='consultation_date'>consultation time: </labelfor></label>";
echo "<input type= 'date' name ='consultation_date'>";// creates input box
echo "<select name='consultant'>";
foreach ($consultants as $name){
    echo "<option  value =".$name['consultantid'].">".$name['consultant_name']."</option>";

}
echo "</select>";





echo "<input type= 'submit' value='book consultation' id='submit'>";// creates input box
echo "</form>";


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>
