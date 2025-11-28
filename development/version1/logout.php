<?php //this opens the php code section
session_start();
require_once "assets/dbconn.php";
require_once "assets/common.php";
session_destroy();
header("Location: index.php?message=you have been logged out!");
?>
