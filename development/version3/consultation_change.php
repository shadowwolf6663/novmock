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

                if (!isset($_SESSION["user"]  )and(!isset($_SESSION["consultant"]) )) {// checks if a user is logged in to reduce attack vectors

                    $_SESSION["usermessage"] = "You must be logged in to access this page!";
                    header("Location: index.php");
                    exit;

                }
                elseif ($_SERVER["REQUEST_METHOD"] === "POST") {// checks request method

                        $tmp=$_POST["consultationdate"]. ' '.$_POST["consultationtime"];
                        $epoch = strtotime($tmp);
                        echo $epoch." seconds";
                        echo "<br>";
                        echo "current: ".time()." seconds";
                        if(consultation_update(dbconnect_update(),$_SESSION['consultationid'], $epoch)){
                            $_SESSION["usermessage"] = "changed consultation";// assigning message
                            if (isset($_SESSION["user"])){

                                auditor(dbconnect_insert(),$_SESSION['userid'],"upd","changed consultation");
                                header("Location: view_consultations.php");
                                exit;

                            }
                        }else{

                            $_SESSION["usermessage"] = "failed to create consultation";// assigning message

                        }
                        echo user_message();// echo message to screen
                }

                $consultation=consultation_getter(dbconnect_select());//should have a try except around this isnce it calls a subroutine that may fail
                echo "<form method='post' action=''>";// opens a form

                    $consultants=consultant_getter(dbconnect_select());
                    $consultation_time=date('h:i:s',$consultation[0]["date_of_consultation"]);
                    $consultation_date=date('Y-m-d',$consultation[0]["date_of_consultation"]);

                    echo "<label for ='consultationtime'>consultation time: </labelfor></label>";
                    echo "<input type= 'time' name ='consultationtime' value = '".$consultation_time. "'>";// creates input box
                    echo "<br>";// breaks to next line
                    echo "<label for ='consultationdate'>consultation time: </labelfor></label>";
                    echo "<input type= 'date' name ='consultationdate' value = '".$consultation_date. "'>";// creates input box
                    echo "<br>";// breaks to next line

                    if (isset($_SESSION["user"])) {

                        echo "<select name='consultant'>";

                            foreach ($consultants as $consultant) {

                                if ($consultation[0]['consultantid'] == $consultant['consultantid']) {
                                    $selected = 'selected';

                                } else {
                                    echo $consultation[0]['consultantid'];

                                    $selected = '';

                                }
                                echo "<option  value =" . $consultant['consultantid'] . ">" . $selected . " ". $consultant['consultant_name'] ."</option>";

                            }
                        echo "</select>";
                    }else{

                        echo "<input type='hidden' name='consultant' value='".$_SESSION['consultantid']."'>";

                    }

                    echo "<input type= 'submit' value='book appointment' id='submit'>";// creates input box

                echo "</form>";


            echo "</div>";

        echo "</div>";

    echo "</body>";

echo "</html>";
?>
