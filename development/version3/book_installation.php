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

            } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {// checks request method

                    $tmp=$_POST["installation_date"]. ' '.$_POST["installation_time"];
                    $epoch = strtotime($tmp);

                    if(create_installation(dbconnect_insert(), $epoch)){

                        $_SESSION["usermessage"] = "sucesfully created installation";// assigning message
                        auditor(dbconnect_insert(),$_SESSION['userid'],"bok","created new installation"); // audits for user
                        header("Location: view_installations.php");
                        exit;

                    }else{

                        $_SESSION["usermessage"] = "failed to create installation";// assigning message

                    }

                    echo user_message();// echo message to screen

            }


            echo "<form method='post' action=''>";// opens a form

                $builders=builder_getter(dbconnect_select());
                $installation_type=["solar_panel","smart_meter"];
                echo "<label for ='installation_time'>installation time: </labelfor></label>";
                echo "<input type= 'time' name ='installation_time'>";// creates input box
                echo "<br>";// breaks to next line
                echo "<label for ='installation_date'>installation time: </labelfor></label>";
                echo "<input type= 'date' name ='installation_date'>";// creates input box
                echo "<br>";// breaks to next line
                echo "<label for ='location'>location: </labelfor></label>";
                echo "<input type= 'text' name ='location'>";// creates input box

                echo "<select name='type'>";

                    foreach ($installation_type as $type){

                        echo "<option  value =".$type.">".$type."</option>";

                    }

                echo "</select>";

                echo "<select name='builder'>";

                    foreach ($builders as $builder){

                        echo "<option  value =".$builder["builderid"].">".$builder["username"]."</option>"; // displays builder name and assigns it the value of the builders id when selected

                    }

                echo "</select>";

                echo "<input type= 'submit' value='book installation' id='submit'>";// creates input box

            echo "</form>";


        echo "</div>";

    echo "</div>";

    echo "</body>";

echo "</html>";
?>
