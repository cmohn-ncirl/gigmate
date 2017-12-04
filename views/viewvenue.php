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
        <title>View Venue</title>
    </head>
    <body>

        <!--    This is the FORM page where the user makes the selection's
                what EVENT they want to view.-->

        <form method="post" action="viewvenue.php" name="viewvenueform">
            <p>Select Event from the drop-down list below</p>
            <select name = "venue_name">
                <option value="">Please select a venue</option>
                <?php
                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if ($conn->connect_error) {
                    die("DB connection failed: " . $conn->connect_error);
                }
                $sqlquery_name = "SELECT venue_name, venue_town from venues";
                $result = $conn->query($sqlquery_name);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value = '" . $row["venue_name"] . "'>" .
                        $row["venue_name"] . " / " . $row["venue_town"] . "</option>\n";
                    }
                    echo "</select>";
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select>
            <p></p><p></p><p></p>

            <p><input type="submit" name="viewvenue" value="View Venue" />
                <input type="reset" value="Reset" /></p>
        </form>
    </body>
</html>
