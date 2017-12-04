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
    </head>
    <body>
        <?php include 'config/kakorna.php' ?>
        <?php
        // put your code here
        // include the configs / constants for the database connection
        require_once("config/db.php");
        // load the registration class
        require_once("classes/ViewContact.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
        $viewevent = new ViewContact();
        ?>

        <h1>GigMate</h1>
        <?php include 'views/navigationbar.php' ?>
        <p>All listed events:</p>

        <table id="viewstuff">
            <tr>
                <th>Contact Firstname</th>
                <th>Contact Lastname</th>
                <th>Country</th>
            </tr>
            <?php
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($conn->connect_error) {
                die("DB connection failed: " . $conn->connect_error);
            }
            $sqlquery = "SELECT contact_firstname, contact_lastname, contact_country from contacts";
            $results = $conn->query($sqlquery);

            if ($results->num_rows > 0) {
                while ($rows = $results->fetch_assoc()) {
                    echo "<tr><td>" . $rows["contact_firstname"] . "</td><td>" . $rows["contact_lastname"] .
                    "</td><td>" . $rows["contact_country"] . "</td></tr>";
                }
                echo "</table>";
                mysqli_free_result($results);
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </table>
        <p></p><p></p><p></p>

        <?php
// show the viewvenue view 
        include("views/viewcontact.php");
        ?>

        <!--         back link -->
        <p><a href="home.php">Back to Home Page</a></p>
    </body>
</html>
