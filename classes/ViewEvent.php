<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewEvent
 *
 * @author Cal
 */
class ViewEvent {

    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;

    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();

    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct() {
        if (isset($_POST["viewevent"])) {
            $this->viewEvent();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function viewEvent() {
//        echo "Selection: " . $_POST['event_name'] . ".....";
        //This is just not to get confused with quotes and single quotes :P
        $namn = $_POST['event_name'];
        $role = $_POST['role'];
//        echo $role; -- this is for debugging only
//        echo ('Creating a DB connection.....');
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

            $sqlquery_event = "SELECT * from events WHERE event_name='$namn'";
            $result = $this->db_connection->query($sqlquery_event);
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0 and $role == "tourmanager") {
                echo "<h1>Event View</h1>";
                echo '<table id = "viewstuff">';
                echo "<tr><th>Event name: </th><th>" . $row["event_name"] .
                "</th></tr><tr><td>Town: </td><td>" . $row["event_town"] .
                "</tr><tr><td>Country: </td><td>" . $row["event_country"] .
                "</tr><tr><td>Date: </td><td>" . $row["event_date"] .
                "</tr><tr><td>Time: </td><td>" . $row["event_time"] .
                "</tr><tr><td>Venue: </td><td>" . $row["event_venue"] .
                "</tr><tr><td>Contact name: </td><td>" . $row["event_contactname"] .
                "</tr><tr><td>Contact phone: </td><td>" . $row["event_contactphone"] .
                "</tr><tr><td>Bus power time: </td><td>" . $row["event_buspowertime"] .
                "</tr><tr><td>Load-in time: </td><td>" . $row["event_loadintime"] .
                "</tr><tr><td>Catering time: </td><td>" . $row["event_cateringtime"] .
                "</tr><tr><td>Soundcheck time: </td><td>" . $row["event_soundchecktime"] .
                "</tr><tr><td>Doors open time: </td><td>" . $row["event_doorsopentime"] .
                "</tr><tr><td>Other info: </td><td>" . $row["event_otherinfo"] .
                "</tr><tr><td colspan='2'><strong>Performance order</strong></td>" .
                "</tr><tr><td>Artist 1 slot: </td><td>" . $row["event_artistslot1time"] .
                "</tr><tr><td>Artist 2 slot: </td><td>" . $row["event_artistslot2time"] .
                "</tr><tr><td>Artist 3 slot: </td><td>" . $row["event_artistslot3time"] .
                "</td></tr>";
                echo "</table>";
            } elseif ($result->num_rows > 0 and $role == "basic") {
                echo "<h1>Event View</h1>";
                echo '<table id = "viewstuff">';
                echo "<tr><th>Event name: </th><th>" . $row["event_name"] .
                "</th></tr><tr><td>Town: </td><td>" . $row["event_town"] .
                "</tr><tr><td>Country: </td><td>" . $row["event_country"] .
                "</tr><tr><td>Date: </td><td>" . $row["event_date"] .
                "</tr><tr><td>Time: </td><td>" . $row["event_time"] .
                "</tr><tr><td>Venue: </td><td>" . $row["event_time"] .
                "</td></tr>";
                echo "</table>";
            } else {
                echo "0 results.";
            }
            mysqli_close($this->db_connection);
        } else {
            $this->errors[] = "Sorry, no database connection.";
        }
        mysqli_free_result($row);
        mysqli_free_result($result);
    }

}
