<?php //this opens the php code section
session_start();
require_once "assets/dbconn.php";
require_once "assets/common.php";
if (isset($_SESSION["user"])) {// checks if a user is logged in to reduce attack vectors and for auditing purposes

    auditor(dbconnect_insert(),$_SESSION["userid"],"lgo","user has logged out"); // audits account as logged out

}
elseif (isset($_SESSION["consultant"])) {// checks if a consultant is logged in to reduce attack vectors and for auditing purposes

    consultantauditor(dbconnect_insert(),$_SESSION["consultantid"],"lgo","consultant has logged out"); // audits account as logged out

}
elseif (isset($_SESSION["builder"])) {// checks if a builder is logged in to reduce attack vectors and for auditing purposes

    builderauditor(dbconnect_insert(),$_SESSION["builderid"],"lgo","builder has logged out"); // audits account as logged out

}
session_destroy(); // destroys session and data stored in session
header("Location: index.php?message=you have been logged out!");// places a message in html link to be decoded as session will be destroyed so cant save message in session
?>
