<?php

/**
 * Class AddEvent
 * handles the Event registration
 */
class AddEvent {

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
     * you know, when you do "$addingevent = new AddEvent();"
     */
    public function __construct() {
        if (isset($_POST["addevent"])) {
            $this->addNewEvent();
        }
    }

    /**
     * handles the entire Event addition process. checks all error possibilities
     * and creates a new event in the database if everything is fine
     */
    private function addNewEvent() {
        echo nl2br('Function addNewEvent starting....');
        if (empty($_POST['event_venue']) && !empty($_POST['venue_name'])) {
            $_POST['event_venue'] = $_POST['venue_name'];
        }
        if (empty($_POST['event_name'])) {
            $this->errors[] = "Empty event name";
        } elseif (strlen($_POST['event_name']) < 2) {
            $this->errors[] = "Event name has a minimum length of 2 characters";
        } elseif (strlen($_POST['event_name']) > 100 || strlen($_POST['event_name']) < 2) {
            $this->errors[] = "Event name cannot be shorter than 2 or longer than 100 characters";
        } elseif (!preg_match('/^[a-z\s\d]{2,100}$/i', $_POST['event_name'])) {
            $this->errors[] = "Event name does not fit the name scheme: only a-Z and numbers are allowed, 2 to 100 characters";
        } elseif (empty($_POST['event_town'])) {
            $this->errors[] = "Event town cannot be empty";
        } elseif (empty($_POST['event_country'])) {
            $this->errors[] = "Event country cannot be empty";
        } elseif (!empty($_POST['event_name']) && strlen($_POST['event_name']) <= 100 && strlen($_POST['event_name']) >= 2 && preg_match('/^[a-z\s\d]{2,100}$/i', $_POST['event_name']) && !empty($_POST['event_town']) && !empty($_POST['event_country'])
        ) {
            // create a database connection
            echo nl2br('Creating a DB connection.....');
//          This is for debugging only, to see the actual
//          DB input if (WHEN!!) we encounted errors.           
//            var_dump($_POST);
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $event_name = $this->db_connection->real_escape_string(strip_tags($_POST['event_name'], ENT_QUOTES));
                $event_town = $this->db_connection->real_escape_string(strip_tags($_POST['event_town'], ENT_QUOTES));
                $event_country = $this->db_connection->real_escape_string(strip_tags($_POST['event_country'], ENT_QUOTES));
                $event_date = $this->db_connection->real_escape_string(strip_tags($_POST['event_date'], ENT_QUOTES));
                $event_time = $this->db_connection->real_escape_string(strip_tags($_POST['event_time'], ENT_QUOTES));
                $event_venue = $this->db_connection->real_escape_string(strip_tags($_POST['event_venue'], ENT_QUOTES));

                $event_contactname = $this->db_connection->real_escape_string(strip_tags($_POST['event_contactname'], ENT_QUOTES));
                $event_contactphone = $this->db_connection->real_escape_string(strip_tags($_POST['event_contactphone'], ENT_QUOTES));
                $event_buspowertime = $this->db_connection->real_escape_string(strip_tags($_POST['event_buspowertime'], ENT_QUOTES));
                $event_loadintime = $this->db_connection->real_escape_string(strip_tags($_POST['event_loadintime'], ENT_QUOTES));
                $event_cateringtime = $this->db_connection->real_escape_string(strip_tags($_POST['event_cateringtime'], ENT_QUOTES));
                $event_soundchecktime = $this->db_connection->real_escape_string(strip_tags($_POST['event_soundchecktime'], ENT_QUOTES));
                $event_doorsopentime = $this->db_connection->real_escape_string(strip_tags($_POST['event_doorsopentime'], ENT_QUOTES));
                $event_otherinfo = $this->db_connection->real_escape_string(strip_tags($_POST['event_otherinfo'], ENT_QUOTES));
                $event_artistslot1time = $this->db_connection->real_escape_string(strip_tags($_POST['event_artistslot1time'], ENT_QUOTES));
                $event_artist1name = $this->db_connection->real_escape_string(strip_tags($_POST['event_artist1name'], ENT_QUOTES));
                $event_artistslot2time = $this->db_connection->real_escape_string(strip_tags($_POST['event_artistslot2time'], ENT_QUOTES));
                $event_artist2name = $this->db_connection->real_escape_string(strip_tags($_POST['event_artist2name'], ENT_QUOTES));
                $event_artistslot3time = $this->db_connection->real_escape_string(strip_tags($_POST['event_artistslot3time'], ENT_QUOTES));
                $event_artist3name = $this->db_connection->real_escape_string(strip_tags($_POST['event_artist3name'], ENT_QUOTES));

                // check if event name already exists
                echo ('Checking name in DB.....');
                $sql = "SELECT * FROM events WHERE event_name = '" . $event_name . "';";
                $query_check_event_name = $this->db_connection->query($sql);

                if ($query_check_event_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that event name is already taken.";
                } else {
                    // write new Event's data into database
                    echo ('Writing to DB......');
                    $sql = "INSERT INTO events (event_name, event_town, event_country, event_date, event_time, event_venue, event_contactname, event_contactphone, event_buspowertime, event_loadintime, event_cateringtime, event_soundchecktime, event_doorsopentime, event_artist1name, event_artist2name, event_artist3name, event_artistslot1time, event_artistslot2time, event_artistslot3time, event_otherinfo, event_timestamp)
                            VALUES('" . $event_name . "', '" . $event_town . "', '" . $event_country . "', '" . $event_date . "', '" . $event_time . "', '" . $event_venue . "', '" . $event_contactname . "', '" . $event_contactphone . "', '" . $event_buspowertime . "', '" . $event_loadintime . "', '" . $event_cateringtime . "', '" . $event_soundchecktime . "', '" . $event_doorsopentime . "', '" . $event_artist1name . "', '" . $event_artist2name . "', '" . $event_artist3name . "', '" . $event_artistslot1time . "', '" . $event_artistslot2time . "', '" . $event_artistslot3time . "', '" . $event_otherinfo . "', CURRENT_TIMESTAMP);";
                    $query_new_event_insert = $this->db_connection->query($sql);

                    // if event has been added successfully
                    if ($query_new_event_insert) {
                        $this->messages[] = "Your Event has been created successfully.";
                    } else {
                        $this->errors[] = "Sorry, your event registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        } mysqli_close($this->db_connection);
    }

}
