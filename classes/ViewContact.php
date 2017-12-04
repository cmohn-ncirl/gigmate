<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewContact
 *
 * @author Cal
 */
class ViewContact {

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
     * you know, when you do "$viewcontact = new ViewContact();"
     */
    public function __construct() {
        if (isset($_POST["viewcontact"])) {
            $this->viewContact();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function viewContact() {
//        echo "Selection: " . $_POST['contact'] . ".....";
//This is just not to get confused with quotes and single quotes :P
        $namn = $_POST['contact'];

//        echo ('Creating a DB connection.....');
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {

            $sqlquery_event = "SELECT * from contacts WHERE contact_id='$namn'";
            $result = $this->db_connection->query($sqlquery_event);
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                echo "<h1>Contact View</h1>";
                echo '<table id = "viewstuff">';
                echo "<tr><th>First name: </th><th>" . $row["contact_firstname"] .
                "</tr><tr><td>Last name: </td><td>" . $row["contact_lastname"] .
                "</th></tr><tr><td>Town: </td><td>" . $row["contact_town"] .
                "</tr><tr><td>Country: </td><td>" . $row["contact_country"] .
                "</tr><tr><td>Contact phone: </td><td>" . $row["contact_phone"] .
                "</tr><tr><td>Contact email: </td><td>" . $row["contact_email"] .
                "</tr><tr><td>Other info: </td><td>" . $row["contact_otherinfo"] .
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
