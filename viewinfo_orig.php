<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <title>View Info</title>
    </head>
    <body>
        <?php
        // put your code here
        session_start();

        if (isset($_SESSION['user_name'])) {
            echo "User ", $_SESSION['user_name'], " is logged in.";
        } else {
            echo "Session error, user not logged in.";
            header('refresh:3;url=index.php');
            die();
        }
        ?>
        <h1>GigMate</h1>
        <?php include 'views/navigationbar.php' ?>
        <p>Please select:</p>
        <ul>
            <li><a href="viewevent.php">View Event</a></li>
            <li><a href="viewvenue.php">View Venue</a></li>
            <li><a href="viewcontact.php">View Contact</a></li>
            <li>Add Artist</li>

        </ul>
    </body>
</html>
