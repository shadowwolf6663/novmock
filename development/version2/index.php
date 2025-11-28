<?php //this opens the php code section
require_once "assets/dbconn.php";
require_once "assets/common.php";

if (!isset($_GET["message"])){//checks if a message variable has been set
    session_start();
    $message = False;//sets $message to false to avoid errors when we compare variables later to check for message
}else{
    //decode message for display
    $message = htmlspecialchars(urldecode($_GET["message"]));//decodes message into readable string
}




echo "<!DOCTYPE html>";  // desired tag to declare what type of page it is

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
if (!$message){
    echo user_message();
}else{
    echo $message;
}



echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>
