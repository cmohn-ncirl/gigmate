<!-- if you need user information, just put them into the $_SESSION variable and output them here -->

<?php
if (isset($_SESSION['user_name'])) {
    echo "Hey ", $_SESSION['user_name'], ", you are logged in. ";
} else {
    echo "Something went wrong. Code: 123456";
}
?>
<br>
<p>Proceed to the <a href="home.php">Home</a> page</p>
<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
<p><a href="index.php?logout">Logout</a></p>

