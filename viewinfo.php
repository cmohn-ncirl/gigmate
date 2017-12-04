<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <title>View Info</title>
    </head>
    <body>
        <?php include 'config/kakorna.php' ?>

        <h1>GigMate</h1>
        <?php include 'views/navigationbar.php' ?>
        <p>Please select:</p>
        <ul>
            <li><a href="viewevent.php">View Event</a></li>
            <li><a href="viewvenue.php">View Venue</a></li>
            <li><a href="viewcontact.php">View Contact</a></li>
            <li>View Artist</li>

        </ul>
    </body>
</html>
