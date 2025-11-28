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

if (!isset($_SESSION["user"]  )and(!isset($_SESSION["builder"]) )) {// checks if a user is logged in to reduce attack vectors
    $_SESSION["usermessage"] = "You must be logged in to access this page!";
    header("Location: index.php");
    exit;
}
elseif ($_SERVER["REQUEST_METHOD"] === "POST") {// checks request method

        $tmp=$_POST["installationdate"]. ' '.$_POST["installationtime"];
        $epoch = strtotime($tmp);
        echo $epoch." seconds";
        echo "<br>";
        echo "current: ".time()." seconds";
        if(installation_update(dbconnect_update(),$_SESSION['installationid'], $epoch)){
            $_SESSION["usermessage"] = "changed installation";// assigning message
            if (isset($_SESSION["user"])){
                header("Location: view_installations.php");
                exit;
            }
        }else{
            $_SESSION["usermessage"] = "failed to create installation";// assigning message
        }

        echo user_message();// echo message to screen

}


echo "<form method='post' action=''>";// opens a form
$builders=builder_getter(dbconnect_select());
$installation=installation_getter(dbconnect_select());//should have a try except around this isnce it calls a subroutine that may fail
$installation_time=date('h:i:s',$installation[0]["date_of_installation"]);
$installation_date=date('Y-m-d',$installation[0]["date_of_installation"]);
$installation_type=["solar_panel","smart_meter"];

echo "<label for ='installationtime'>installation time: </labelfor></label>";
echo "<input type= 'time' name ='installationtime' value = '".$installation_time. "'>";// creates input box
echo "<br>";// breaks to next line
echo "<label for ='installationdate'>installation time: </labelfor></label>";
echo "<input type= 'date' name ='installationdate' value = '".$installation_date. "'>";// creates input box


echo "<br>";// breaks to next line
echo "<label for ='location'>location: </labelfor></label>";
echo "<input type= 'text' name ='location' value=".$installation[0]['location_of_installation'].">";// creates input box

echo "<select name='type'>";

foreach ($installation_type as $type){

    if ($installation[0]['installation_type'] == $type) {

        $selected = 'selected';

    } else {

        $selected = '';

    }
    echo "<option  value =".$type.">".$selected." ".$type."</option>";

}
echo "</select>";

if (isset($_SESSION["user"])) {

    echo "<select name='builder'>";

    foreach ($builders as $builder) {

        if ($installation[0]['builderid'] == $builder['builderid']) {

            $selected = 'selected';

        } else {

            $selected = '';

        }
        echo "<option  value =" . $builder['builderid'] . ">" . $selected . " ". $builder['username'] ."</option>";

    }
    echo "</select>";
}else{

    echo "<input type='hidden' name='builder' value='".$_SESSION['builderid']."'>";

}




echo "<input type= 'submit' value='book installation' id='submit'>";// creates input box
echo "</form>";


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>
