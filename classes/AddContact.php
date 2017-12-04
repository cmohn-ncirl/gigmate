<?php

/**
 * Class AddContact
 * handles the Contact registration
 */
class AddContact {

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
     * you know, when you do "$addingcontact = new AddContact();"
     */
    public function __construct() {
        if (isset($_POST["addcontact"])) {
            $this->addNewContact();
        }
    }

    /**
     * handles the entire Contact addition process. checks all error possibilities
     * and creates a new contact in the database if everything is fine
     */
    private function addNewContact() {
        echo ('Function addNewContact starting....');
        if (empty($_POST['contact_firstname'])) {
            $this->errors[] = "Empty contact first name";
        } elseif (!preg_match('/^[a-z\s\d]{2,64}$/i', $_POST['contact_firstname'])) {
            $this->errors[] = "Contact first name does not fit the name scheme: only a-Z and numbers are allowed, 2 to 100 characters";
        } elseif (!preg_match('/^[a-z\s\d]{2,64}$/i', $_POST['contact_lastname'])) {
            $this->errors[] = "Contact last name does not fit the name scheme: only a-Z and numbers are allowed, 2 to 100 characters";
        } elseif (empty($_POST['contact_town'])) {
            $this->errors[] = "Contact town cannot be empty";
        } elseif (empty($_POST['contact_country'])) {
            $this->errors[] = "Contact country cannot be empty";
        } elseif (!empty($_POST['contact_firstname']) && !empty($_POST['contact_lastname'])  && preg_match('/^[a-z\s\d]{2,100}$/i', $_POST['contact_firstname']) && preg_match('/^[a-z\s\d]{2,100}$/i', $_POST['contact_lastname']) && !empty($_POST['contact_town']) && !empty($_POST['contact_country'])
        ) {
            // create a database connection
            echo ('Creating a DB connection.....\n');
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $contact_firstname = $this->db_connection->real_escape_string(strip_tags($_POST['contact_firstname'], ENT_QUOTES));
                $contact_lastname = $this->db_connection->real_escape_string(strip_tags($_POST['contact_lastname'], ENT_QUOTES));
                $contact_town = $this->db_connection->real_escape_string(strip_tags($_POST['contact_town'], ENT_QUOTES));
                $contact_country = $this->db_connection->real_escape_string(strip_tags($_POST['contact_country'], ENT_QUOTES));
                $contact_phone = $this->db_connection->real_escape_string(strip_tags($_POST['contact_phone'], ENT_QUOTES));
                $contact_email = $this->db_connection->real_escape_string(strip_tags($_POST['contact_email'], ENT_QUOTES));
                $contact_otherinfo = $this->db_connection->real_escape_string(strip_tags($_POST['contact_otherinfo'], ENT_QUOTES));

                // check if contact name already exists
                echo ('Checking name in DB.....');
                $sql = "SELECT * FROM contacts WHERE contact_firstname = '" . $contact_firstname . "';";
                $query_check_contact_name = $this->db_connection->query($sql);

                if ($query_check_contact_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that contact name is already taken.";
                } else {
                    // write new Contact's data into database
                    echo ('Writing to DB......');
                    $sql = "INSERT INTO contacts (contact_timestamp, contact_firstname, contact_lastname, contact_town, contact_country, contact_phone, contact_email, contact_otherinfo)
                            VALUES(CURRENT_TIMESTAMP, '" . $contact_firstname . "', '" . $contact_lastname . "', '" . $contact_town . "', '" . $contact_country . "', '" . $contact_phone . "', '" . $contact_email . "', '" . $contact_otherinfo . "');";
                    $query_new_contact_insert = $this->db_connection->query($sql);

                    // if contact has been added successfully
                    if ($query_new_contact_insert) {
                        $this->messages[] = "Your Contact has been created successfully.";
                    } else {
                        $this->errors[] = "Sorry, your contact registration failed. Please go back and try again.";
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
