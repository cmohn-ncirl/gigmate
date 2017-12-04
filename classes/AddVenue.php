<?php

/**
 * Class AddVenue
 * handles the Venue registration
 */
class AddVenue {

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
     * you know, when you do "$addingvenue = new AddVenue();"
     */
    public function __construct() {
        if (isset($_POST["addvenue"])) {
            $this->addNewVenue();
        }
    }

    /**
     * handles the entire Venue addition process. checks all error possibilities
     * and creates a new venue in the database if everything is fine
     */
    private function addNewVenue() {
        echo ('Function addNewVenue starting....');
        if (empty($_POST['venue_name'])) {
            $this->errors[] = "Empty venue name!";
        } elseif (empty($_POST['venue_town'])) {
            $this->errors[] = "Empty town name!";
        } elseif (empty($_POST['venue_country'])) {
            $this->errors[] = "Empty country name!";
        } elseif (!empty($_POST['venue_name']) && !empty($_POST['venue_town']) && !empty($_POST['venue_country'])
        ) {
            // create a database connection
            echo ('Creating a DB connection.....');
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $venue_name = $this->db_connection->real_escape_string(strip_tags($_POST['venue_name'], ENT_QUOTES));
                $venue_town = $this->db_connection->real_escape_string(strip_tags($_POST['venue_town'], ENT_QUOTES));
                $venue_country = $this->db_connection->real_escape_string(strip_tags($_POST['venue_country'], ENT_QUOTES));
                $venue_contactname = $this->db_connection->real_escape_string(strip_tags($_POST['venue_contactname'], ENT_QUOTES));
                $venue_contactphone = $this->db_connection->real_escape_string(strip_tags($_POST['venue_contactphone'], ENT_QUOTES));
                $venue_contactemail = $this->db_connection->real_escape_string(strip_tags($_POST['venue_contactemail'], ENT_QUOTES));
                $venue_capacity = $this->db_connection->real_escape_string(strip_tags($_POST['venue_capacity'], ENT_QUOTES));
                $venue_otherinfo = $this->db_connection->real_escape_string(strip_tags($_POST['venue_otherinfo'], ENT_QUOTES));

                // check if venue name already exists
                echo ('Checking name in DB.....');
                $sql = "SELECT * FROM venues WHERE venue_name = '" . $venue_name . "';";
                $query_check_venue_name = $this->db_connection->query($sql);

                if ($query_check_venue_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that venue name is already taken.";
                } else {
                    // write new Venue's data into database
                    echo ('Writing to DB......');
                    var_dump($_POST);
                    $sql = "INSERT INTO venues (venue_timestamp, venue_name, venue_town, venue_country, venue_contactname, venue_contactphone, venue_contactemail, venue_capacity, venue_otherinfo)
                            VALUES(CURRENT_TIMESTAMP, '" . $venue_name . "', '" . $venue_town . "', '" . $venue_country . "', '" . $venue_contactname . "', '" . $venue_contactphone . "', '" . $venue_contactemail . "', '" . $venue_capacity . "', '" . $venue_otherinfo . "');";
                    $query_new_venue_insert = $this->db_connection->query($sql);

                    // if venue has been added successfully
                    if ($query_new_venue_insert) {
                        $this->messages[] = "Your Venue has been created successfully.";
                        mysqli_close($this->db_connection);
                    } else {
                        $this->errors[] = "Sorry, your venue registration failed. Please go back and try again.";
                        mysqli_close($this->db_connection);
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
            mysqli_close($this->db_connection);
        } 
    }
}
