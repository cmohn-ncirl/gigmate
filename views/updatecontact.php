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
        <title>Update Contact</title>
    </head>
    <body>
        <h1>GigMate</h1>
        <?php include 'views/navigationbar.php' ?>
        <!--    This is the FORM page where the user makes the selection's
                what CONTACT they want to view.-->

        <form method="post" action="updatecontact.php" name="updatecontactform">
            <p>Select Contact from the drop-down list below</p>
            <select name = "contact">
                <option value="">Please select a contact</option>
                <?php
                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if ($conn->connect_error) {
                    die("DB connection failed: " . $conn->connect_error);
                }
                $sqlquery_name = "SELECT contact_id, contact_firstname, contact_lastname from contacts";
                $result = $conn->query($sqlquery_name);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value = '" . $row["contact_id"] . "'>" .
                        $row["contact_firstname"] . " " . $row["contact_lastname"] . "</option>\n";
                    }
                    echo "</select>";
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select>
            <p></p><p></p><p></p>

            <p><input type="submit" name="updatecontact" value="Update Contact" />
                <input type="reset" value="Reset" /></p>
        </form>
    </body>
</html>
