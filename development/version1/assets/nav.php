<?php
echo "<div class='navi'>";//declares class
echo "<nav>";// start nav

echo "<ul>";//declares unordered list
if (isset($_SESSION["user"])) {// checks if a user is logged in to reduce attack vectors

    echo "<li><a href='index.php'>main</a></li>";  // link to different page
    echo "<li><a href='logout.php'>logout</a></li>";  // link to different page

}
else { // if no other conditions are met it will execute the following

    echo "<li><a href='index.php'>main</a></li>";  // link to different page
    echo "<li><a href='login.php'>login</a></li>";  // link to different page
    echo "<li><a href='register_user.php'>register</a></li>";  // link to different page

}
echo "</ul>";//closes list

echo "</nav>";
echo "</div>";
?>
