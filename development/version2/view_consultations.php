<?php //this opens the php code section
session_start(); // start session

require_once "assets/dbconn.php"; // connects to another file
require_once "assets/common.php"; // connects to another file

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

if (!isset($_SESSION["user"])) {// checks if a user is logged in to reduce attack vectors
    $_SESSION["usermessage"] = "You must be logged in to access this page!";
    header("Location: index.php");
    exit;
}elseif($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["consultationdelete"])){

            if (cancel_consultation(dbconnect_delete(),$_POST["consultationid"])){
                $_SESSION["usermessage"] = "consultation has been deleted successfully!.";
            }else{
                $_SESSION["usermessage"] = "Unable to delete consultation!.";
            }

    }elseif(isset($_POST["consultationchange"])){

            $consultation=consultation_fetch(dbconnect_select(),$_POST["consultationid"]);
            if ($consultation){
                $_SESSION["consultationid"]=$_POST["consultationid"];
                header("location: consultation_change.php");
                exit;
            }

    }
}
else  {// checks request method
    echo user_message();// echo message to screen

        $consultations=consultation_getter(dbconnect_select());
        if (!$consultations){
            echo "No consultations found!";
        }else {
            echo "<table>";
            echo "<tr>";
            echo "<th>user</th>";
            echo "<th>consultation date</th>";
            echo "<th>consultant</th>";
            echo "<th>change/delete</th>";
            echo "</tr>";
            foreach ($consultations as $consultation) {
                echo "<form method='post' action=''>";
                echo "<tr>";
                echo "<td>".$consultation['userid']."</td>";
                echo "<td>date: ".date('M d, Y @ h:i A',$consultation['date_of_consultation'])." </td>";
                echo "<td>with: ".$consultation['consultant_name']."</td>";
                echo "<td><input type='hidden' name='consultationid' value='".$consultation['consultationid']."'>
                    <input type='submit' name='consultationdelete' value='delete consultation'>
                    <input type='submit' name='consultationchange' value='change consultation'></td>";
                echo "</tr>";
                echo "</form>";

            }
            echo "</table>";

        }
}


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>
