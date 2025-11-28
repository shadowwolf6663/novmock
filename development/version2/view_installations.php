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
    if (isset($_POST["installationdelete"])){

        if (cancel_installation(dbconnect_delete(),$_POST["installationid"])){
            $_SESSION["usermessage"] = "installation has been deleted successfully!.";
        }else{
            $_SESSION["usermessage"] = "Unable to delete installation!.";
        }

    }elseif(isset($_POST["installationchange"])){

        $installation=installation_fetch(dbconnect_select(),$_POST["installationid"]);
        if ($installation){
            $_SESSION["installationid"]=$_POST["installationid"];
            header("location: installation_change.php");
            exit;
        }

    }
}
else  {// checks request method
    echo user_message();// echo message to screen

    $installations=installation_getter(dbconnect_select());
    if (!$installations){
        echo "No installations found!";
    }else {
        echo "<table>";
        echo "<tr>";
        echo "<th>user</th>";
        echo "<th>installation date</th>";
        echo "<th>builder</th>";
        echo "<th>location of installation</th>";
        echo "<th>installation type</th>";
        echo "<th>change/delete</th>";
        echo "</tr>";
        foreach ($installations as $installation) {
            echo "<form method='post' action=''>";
            echo "<tr>";
            echo "<td>".$installation['userid']."</td>";
            echo "<td>date: ".date('M d, Y @ h:i A',$installation['date_of_installation'])." </td>";
            echo "<td>with: ".$installation['username']."</td>";
            echo "<td>at: ".$installation['location_of_installation']."</td>";
            echo "<td>".$installation['installation_type']."</td>";
            echo "<td><input type='hidden' name='installationid' value='".$installation['installationid']."'>
                    <input type='submit' name='installationdelete' value='delete installation'>
                    <input type='submit' name='installationchange' value='change installation'></td>";
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

