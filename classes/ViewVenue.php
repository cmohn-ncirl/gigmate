<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewVenue
 *
 * @author Cal
 */
class ViewVenue {

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
     * you know, when you do "$viewvenue = new ViewVenue();"
     */
    public function __construct() {
        if (isset($_POST["viewvenue"])) {
            $this->viewVenue();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function viewVenue() {
//        echo "Selection: " . $_POST['venue_name'] . ".....";
        
//This is just not to get confused with quotes and single quotes :P
        $namn = $_POST['venue_name'];

//        echo ('Creating a DB connection.....');
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

            $sqlquery_event = "SELECT * from venues WHERE venue_name='$namn'";
            $result = $this->db_connection->query($sqlquery_event);
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                echo "<h1>Venue View</h1>";
                echo '<table id = "viewstuff">';
                echo "<tr><th>Venue name: </th><th>" . $row["venue_name"] .
                "</th></tr><tr><td>Town: </td><td>" . $row["venue_town"] .
                "</tr><tr><td>Country: </td><td>" . $row["venue_country"] .
                "</tr><tr><td>Contact name: </td><td>" . $row["venue_contactname"] .
                "</tr><tr><td>Contact phone: </td><td>" . $row["venue_contactphone"] .
                "</tr><tr><td>Contact email: </td><td>" . $row["venue_contactemail"] .
                "</tr><tr><td>Venue capacity: </td><td>" . $row["venue_capacity"] .
                "</tr><tr><td>Other info: </td><td>" . $row["venue_otherinfo"] .
                "</td></tr>";
                echo "</table>";
            } else {
                echo "0 results";
            }
            mysqli_close($this->db_connection);
        } else {
            $this->errors[] = "Sorry, no database connection.";
        }
        mysqli_free_result($row);
    }

}
