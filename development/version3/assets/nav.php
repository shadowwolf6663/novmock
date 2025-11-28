<?php
echo "<div class='navi'>";//declares class
echo "<nav>";// start nav

echo "<ul>";//declares unordered list
if (isset($_SESSION["user"])) {// checks if a user is logged in to reduce attack vectors

    echo "<li><a href='index.php'>MAIN</a></li>";  // link to different page
    echo "<li><a href='view_installations.php'>INSTALLATIONS</a></li>";  // link to different page
    echo "<li><a href='view_consultations.php'>CONSULTATIONS</a></li>";  // link to different page
    echo "<li><a href='book_installation.php'>BOOK INSTALLATION</a></li>";  // link to different page
    echo "<li><a href='book_consultation.php'>BOOK CONSULTATION</a></li>";  // link to different page
    echo "<li><a href='logout.php'>LOGOUT</a></li>";  // link to different page

}
elseif (isset($_SESSION["builder"])) {

    echo "<li><a href='index.php'>MAIN</a></li>";  // link to different page
    echo "<li><a href='builder_view_installations.php'>VIEW INSTALLATIONS</a></li>";  // link to different page
    echo "<li><a href='logout.php'>LOGOUT</a></li>";  // link to different page

}
elseif (isset($_SESSION["consultant"])) {

    echo "<li><a href='index.php'>MAIN</a></li>";  // link to different page
    echo "<li><a href='consultant_view_consultations.php'>VIEW CONSULTATIONS</a></li>";  // link to different page
    echo "<li><a href='logout.php'>LOGOUT</a></li>";  // link to different page

}
else { // if no other conditions are met it will execute the following

    echo "<li><a href='index.php'>MAIN</a></li>";  // link to different page
    echo "<li><a href='login.php'>USER LOGIN</a></li>";  // link to different page
    echo "<li><a href='login_builder.php'>BUILDER LOGIN</a></li>";  // link to different page
    echo "<li><a href='login_consultant.php'>CONSULTANT LOGIN</a></li>";  // link to different page
    echo "<li><a href='register_user.php'>REGISTER</a></li>";  // link to different page

}
echo "</ul>";//closes list

echo "</nav>";
echo "</div>";
?>
