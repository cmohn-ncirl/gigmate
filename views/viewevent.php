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
        <title>View event</title>
    </head>
    <body>

        <!--    This is the FORM page where the user makes the selection's
                what EVENT they want to view.-->

        <form method="post" action="viewevent.php" name="vieweventform">
            <p>Select Event from the drop-down list below</p>
            <select name = "event_name">
                <option value="">Please select an event</option>
                <?php
                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if ($conn->connect_error) {
                    die("DB connection failed: " . $conn->connect_error);
                }
                $sqlquery_name = "SELECT event_name, event_date from events";
                $result = $conn->query($sqlquery_name);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value = '" . $row["event_name"] . "'>" .
                        $row["event_name"] . " | " . $row["event_date"] . "</option>\n";
                    }
//                    echo "</select>";
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select>
            Select viewing format:<br/>
            <input type="radio" name="role" value="basic" checked> Short view<br/>
            <input type="radio" name="role" value="tourmanager"> Verbose view<br/>

            <p><input type="submit" name="viewevent" value="View Event" />
                <input type="reset" value="Reset" /></p>
        </form>
    </body>
</html>
