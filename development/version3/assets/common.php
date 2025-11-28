<?php

function user_message(){  // declaring function

    if(isset($_SESSION["usermessage"])){  // checks condition is met

        $message= '<div id = "message">'.$_SESSION["usermessage"].'</div>';  // gets user message from session
        unset($_SESSION["usermessage"]);  // removes message from session
        return  $message;  // returns value to calling function

    }else{  // if other conditions aren't met

        $message= "";  // sets value to blank
        return $message;  // returns value

    }
}

function new_user($conn, $post)
{  // declaring function

    $sql = "INSERT INTO users(username,password,date_joined) VALUES(?,?,?)";// doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $hpsw=password_hash($post['password'],PASSWORD_DEFAULT);
    $epoch=time(); // getting current time in epoch time
    $stmt->bindparam(1,$post['username']);
    $stmt->bindparam(2,$hpsw);
    $stmt->bindparam(3,$epoch);
    $stmt->execute(); // runs the insert query

    $conn = null;  // voids connection to db for security reason since it no longer needs to be accessed

}

function new_consultant($conn, $post)
{  // declaring function

    $sql = "INSERT INTO consultants(username,password,date_joined,consultant_name) VALUES(?,?,?,?)";// doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $hpsw=password_hash($post['password'],PASSWORD_DEFAULT);
    $epoch=time(); // getting current time in epoch time
    $stmt->bindparam(1,$post['username']);
    $stmt->bindparam(2,$hpsw);
    $stmt->bindparam(3,$epoch);
    $stmt->bindparam(4,$post['name']);
    $stmt->execute(); // runs the insert query

    $conn = null;  // voids connection to db for security reason since it no longer needs to be accessed

}

function new_builder($conn, $post)
{  // declaring function

    $sql = "INSERT INTO builders(username,password,date_joined) VALUES(?,?,?)";// doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $hpsw=password_hash($post['password'],PASSWORD_DEFAULT);
    $epoch=time(); // getting current time in epoch time
    $stmt->bindparam(1,$post['username']);
    $stmt->bindparam(2,$hpsw);
    $stmt->bindparam(3,$epoch);
    $stmt->execute(); // runs the insert query

    $conn = null;  // voids connection to db for security reason since it no longer needs to be accessed

}

function login($conn, $post){  // declaring function

    $sql = "SELECT * FROM users WHERE username=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $post["username"]);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn = null;    // terminates connection to database

    if($result){  // checks condition is met

        return $result;  // returns value

    }else{  // if other conditions aren't met

        $_SESSION["error"] = "user not found";
        header("Location: login.php");  // redirects to different page
        exit;  // stops further execution

    }

}

function login_builder($conn, $post){  // declaring function

    $sql = "SELECT * FROM builders WHERE username=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $post["username"]);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn = null;    // terminates connection to database

    if($result){  // checks condition is met

        return $result;  // returns value

    }else{  // if other conditions aren't met

        $_SESSION["error"] = "user not found";
        header("Location: login.php");  // redirects to different page
        exit;  // stops further execution

    }

}

function login_consultant($conn, $post){  // declaring function

    $sql = "SELECT * FROM consultants WHERE username=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $post["username"]);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn = null;    // terminates connection to database

    if($result){  // checks condition is met

        return $result;  // returns value

    }else{  // if other conditions aren't met

        $_SESSION["error"] = "user not found";
        header("Location: login.php");  // redirects to different page
        exit;  // stops further execution

    }

}

function consultant_getter($conn){  // declaring function

    $sql = "SELECT * FROM consultants";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database
    $stmt->execute();  // executes sql query

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result;  // returns value

}

function builder_getter($conn){  // declaring function

    $sql = "SELECT * FROM builders";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database
    $stmt->execute();  // executes sql query

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result;  // returns value

}

function create_consultation($conn,$epoch){  // declaring function

    $sql="INSERT INTO consultations (userid,consultantid,date_of_consultation,date_booked) VALUES (?,?,?,?)";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database
    $epoch_current=time(); // getting current time in epoch time

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$_SESSION['userid']);
    $stmt->bindparam(2,$_POST['consultant']);
    $stmt->bindparam(3,$epoch);
    $stmt->bindparam(4,$epoch_current);
    $stmt->execute();  // executes sql query

    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return True;  // returns value

}

function create_installation($conn,$epoch){  // declaring function

    $sql="INSERT INTO installations (userid,builderid,location_of_installation,installation_type,date_of_installation,date_booked) VALUES (?,?,?,?,?,?)";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database
    $epoch_current=time(); // getting current time in epoch time

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$_SESSION['userid']);
    $stmt->bindparam(2,$_POST['builder']);
    $stmt->bindparam(3,$_POST['location']);
    $stmt->bindparam(4,$_POST['type']);
    $stmt->bindparam(5,$epoch);
    $stmt->bindparam(6,$epoch_current);
    $stmt->execute();  // executes sql query

    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return True;  // returns value

}

function consultation_fetch($conn,$consultationid){  // declaring function

    $sql="SELECT * FROM consultations WHERE consultationid=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$consultationid);
    $stmt->execute();

    $results=$stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $results;  // returns value

}

function cancel_consultation($conn,$consultationid){  // declaring function

    $sql="DELETE FROM consultations WHERE consultationid=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$consultationid);
    $stmt->execute();  // executes sql query

    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return True;  // returns value

}

function installation_fetch($conn,$installationid){  // declaring function

    $sql="SELECT * FROM installations WHERE installationid=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$installationid);
    $stmt->execute();

    $results=$stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $results;  // returns value

}

function cancel_installation($conn,$installationid){  // declaring function

    $sql="DELETE FROM installations WHERE installationid=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$installationid);
    $stmt->execute();  // executes sql query

    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return True;  // returns value

}

function consultation_getter($conn){  // declaring function

    $sql = "SELECT c.consultationid,c.date_of_consultation,co.consultant_name,c.consultantid,c.userid FROM consultations c JOIN consultants co on c.consultantid=co.consultantid where c.userid=? order by c.date_of_consultation ASC";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$_SESSION['userid']);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result;  // returns value

}

function consultation_getter_consultant($conn){  // declaring function

    $sql = "SELECT c.consultationid,c.date_of_consultation,u.username,c.consultantid,c.userid FROM consultations c JOIN users u on c.userid=u.userid where c.consultantid=? order by c.date_of_consultation ASC";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$_SESSION['consultantid']);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result;  // returns value

}

function installation_getter($conn){  // declaring function

    $sql = "SELECT i.installationid,i.date_of_installation,i.installation_type,i.location_of_installation,b.username,i.builderid,i.userid FROM installations i JOIN builders b on i.builderid=b.builderid where i.userid=? order by i.date_of_installation ASC";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$_SESSION['userid']);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result;  // returns value

}

function installation_getter_builder($conn){  // declaring function

    $sql = "SELECT i.installationid,i.date_of_installation,i.installation_type,i.location_of_installation,u.username,i.builderid,i.userid FROM installations i JOIN users u on i.userid=u.userid where i.builderid=? order by i.date_of_installation ASC";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1,$_SESSION['builderid']);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result;  // returns value

}

function installation_update($conn,$installationid,$installationtime){  // declaring function

    $sql="UPDATE installations SET builderid=?,date_of_installation=?,installation_type=? WHERE installationid=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindParam(1,$_POST["builder"]);
    $stmt->bindParam(2,$installationtime);
    $stmt->bindParam(3,$_POST["type"]);
    $stmt->bindParam(4,$installationid);
    $stmt->execute();  // executes sql query

    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return True;  // returns value

}

function consultation_update($conn,$consultationid,$consultationtime){  // declaring function

    $sql="UPDATE consultations SET consultantid=?,date_of_consultation=? WHERE consultationid=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt=$conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindParam(1,$_POST["consultant"]);
    $stmt->bindParam(2,$consultationtime);
    $stmt->bindParam(3,$consultationid);
    $stmt->execute();  // executes sql query

    $conn=null;  // voids connection to db for security reason since it no longer needs to be accessed
    return True;  // returns value

}

function auditor($conn, $userid,$code,$long){  // declaring function

    $sql = "INSERT INTO user_audit(date,userid,code,longdesc) VALUES(?,?,?,?)";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    $date = time();  // sets a value for the sql query

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $date);
    $stmt->bindparam(2, $userid);
    $stmt->bindparam(3, $code);
    $stmt->bindparam(4, $long);
    $stmt->execute();  // executes sql query

    $conn = null;  // terminates connection to database
    return true;  // returns value

}

function consultantauditor($conn, $consultantid,$code,$long){  // declaring function

    $sql = "INSERT INTO consultant_audit(date,consultantid,code,longdesc) VALUES(?,?,?,?)";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    $date = time();  // sets a value for the sql query

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $date);
    $stmt->bindparam(2, $consultantid);
    $stmt->bindparam(3, $code);
    $stmt->bindparam(4, $long);
    $stmt->execute();  // executes sql query

    $conn = null;  // terminates connection to database
    return true;  // returns value

}

function builderauditor($conn, $builderid,$code,$long){  // declaring function

    $sql = "INSERT INTO builder_audit(date,builderid,code,longdesc) VALUES(?,?,?,?)";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    $date = time();  // sets a value for the sql query

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $date);
    $stmt->bindparam(2, $builderid);
    $stmt->bindparam(3, $code);
    $stmt->bindparam(4, $long);
    $stmt->execute();  // executes sql query

    $conn = null;  // terminates connection to database
    return true;  // returns value

}

function getnewuserid($conn,$username){  // declaring function

    $sql = "SELECT userid FROM users WHERE username=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $username);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn = null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result["userid"];  // returns value

}

function getnewconsultantid($conn,$username){  // declaring function

    $sql = "SELECT consultantid FROM consultants WHERE username=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $username);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn = null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result["consultantid"];  // returns value

}

function getnewbuilderid($conn,$username){  // declaring function

    $sql = "SELECT builderid FROM builders WHERE username=?";  // doing a prepared statement by sending values separately, bound separately
    $stmt = $conn->prepare($sql);  // prepares sql statement with connection to database

    // binding data from form to sql statement parameter making it more secure from a sql injection attack unlikely to hijack my sql statement
    $stmt->bindparam(1, $username);
    $stmt->execute();  // executes sql query

    $result = $stmt->fetch(PDO::FETCH_ASSOC);  // fetches results from sql query
    $conn = null;  // voids connection to db for security reason since it no longer needs to be accessed
    return $result["builderid"];  // returns value

}

function num_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        $_SESSION["strength"] = 0; // setting count variable

        if (preg_match('/[0-9]/', $_SESSION["password"])) { //if condition is met

            $_SESSION["strength"] += 1; // increments value

        } else { // if no other conditions are met

            $numcheck = "<div id='bad'>doesnt contain a integer</div>"; // creating a message to be returned
            return $numcheck; // return value to calling function

        }

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function len_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        $length = strlen($_SESSION["password"]);

        if ($length >= 8) { //if condition is met

            $_SESSION["strength"] += 1; // increments value

        } else { // if no other conditions are met

            $lencheck = "<div id='bad'>is not 8 characters in length</div>"; // creating a message to be returned
            return $lencheck; // return value to calling function

        }

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function upper_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        if (preg_match('/[A-Z]/', $_SESSION["password"])) { //if condition is met

            $_SESSION["strength"] += 1; // increments value

        } else { // if no other conditions are met

            $upper_check = "<div id='bad'>doesnt contain uppercase</div>"; // creating a message to be returned
            return $upper_check; // return value to calling function

        }

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function lower_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        if (preg_match('/[a-z]/', $_SESSION["password"])) { //if condition is met

            $_SESSION["strength"] += 1; // increments value

        } else { // if no other conditions are met

            $lower_check = "<div id='bad'>doesnt contain lowercase</div>"; // creating a message to be returned
            return $lower_check; // return value to calling function

        }

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function special_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        if (preg_match('/[^a-zA-Z0-9_]/', $_SESSION["password"])) { //if condition is met

            $_SESSION["strength"] += 1; // increments value

        } else { // if no other conditions are met
            $special_check = "<div id='bad'>doesn’t contain a special character</div>"; // creating a message to be returned
            return $special_check; // return value to calling function
        }

    } else { // if no other conditions are met

        return ""; // return value to calling function
    }
}

function first_special_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        if (!preg_match('/[a-zA-Z0-9_]/', $_SESSION["password"][0])) { //if condition is met

            $first_special_check = "<div id='bad'>first character  is special</div>"; // creating a message to be returned
            return $first_special_check; // return value to calling function

        } else { // if no other conditions are met

            $_SESSION["strength"] += 1; // increments value

        }

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function last_special_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        if (!preg_match('/[a-zA-Z0-9_]/', $_SESSION["password"][strlen($_SESSION["password"]) - 1])) { //if condition is met

            $last_special_check = "<div id='bad'>last character is special</div>"; // creating a message to be returned
            return $last_special_check; // return value to calling function

        } else { // if no other conditions are met

            $_SESSION["strength"] += 1; // increments value

        }

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function common_check()
{ // declaring function

    $common_words = ["password", "qwerty"]; // list of common passwords

    if (isset($_SESSION["password"])) { // checks variable has been set //if condition is met

        foreach ($common_words as $word) { // iterates through all items in the list

            if (str_contains($_SESSION["password"], $word)) { //if condition is met

                $common_check = "<div id='bad'>contains common password, " . $word . "</div>"; // creating a message to be returned
                return $common_check; // return value to calling function

            }
        }

        $_SESSION["strength"] += 1; // increments value

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function first_num_check()
{ // declaring function

    if (isset($_SESSION["password"])) { // checks variable has been set

        if (!preg_match('/[0-9]/', $_SESSION["password"][0])) { //if condition is met

            $_SESSION["strength"] += 1; // increments value

        } else { // if no other conditions are met

            $first_num_check = "<div id='bad'>first character is a number</div>"; // creating a message to be returned
            return $first_num_check; // return value to calling function

        }

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}

function strength_check()
{ // declaring function

    if (isset($_SESSION["password"])) { //if condition is met

        $_SESSION["password"] = ""; // blanks value
        unset($_SESSION["password"]); // unsets value

        if ($_SESSION["strength"] >= 8) { //if condition is met

            $strength = "<div id= 'good'> strength of password: " . $_SESSION["strength"] . "/9</div> "; // creating a message to be returned
        } elseif ($_SESSION["strength"] >= 4) { // if other condition isn't met but this condition is met

            $strength = "<div id= 'medium'> strength of password: " . $_SESSION["strength"] . "/9</div> "; // creating a message to be returned
        } else { // if no other conditions are met

            $strength = "<div id= 'bad'> strength of password: " . $_SESSION["strength"] . "/9</div> "; // creating a message to be returned
        }

        return $strength; // return value to calling function

    } else { // if no other conditions are met

        return ""; // return value to calling function

    }
}
?>