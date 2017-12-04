<?php

/*
 * I broke this out to a separate file to be included,
 * seems to work nicely. -cm
 */

session_start();
$currentCookieParams = session_get_cookie_params();
$sidvalue = session_id();
setcookie(
        'PHPSESSID', //name  
        $sidvalue, //value  
        0, //expires at end of session  
        $currentCookieParams['path'], //path  
        $currentCookieParams['domain'], //domain  
        true //secure  
);
if (isset($_SESSION['user_name'])) {
    echo "User ", $_SESSION['user_name'], " is logged in.";
} else {
    echo "Session error, user not logged in.";
    header('refresh:3;url=index.php');
    die();
}
?>