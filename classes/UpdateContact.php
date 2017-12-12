<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdateContact
 *
 * @author Cal
 */
class UpdateContact {

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
        if (isset($_POST["updatecontact"])) {
            $this->updateContact();
        } elseif (isset($_POST["updatecontract2"])) {
            $this->updateContact2();
        }
    }

    private function updateContact() {
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
                echo '<form method="post" action="updatecontact.php" name="updatecontactform">';
                echo '<table id="addstuff">';
                echo '<h1>Update Contact</h1>';
                echo '<tr><td>First name:</td><td><input type="text" name="contact_firstname" '
                . 'value="' . $row["contact_firstname"] . '" required /></td></tr>';
                echo '<tr><td>Last name:</td><td><input type="text" name="contact_lastname" '
                . 'value="' . $row["contact_lastname"] . '" required /></td></tr>';
                echo '<tr><td>Town:</td><td><input type="text" name="contact_town" '
                . 'value="' . $row["contact_town"] . '" required /></td></tr>';
                echo '<tr><td>Country:</td><td><input type="text" name="contact_country" '
                . 'value="' . $row["contact_country"] . '" required /></td></tr>';
                echo '<tr><td>Contact phone:</td><td><input type="text" name="contact_phone" '
                . 'value="' . $row["contact_phone"] . '" required /></td></tr>';
                echo '<tr><td>Contact phone:</td><td><input type="text" name="contact_phone" '
                . 'value="' . $row["contact_email"] . '" required /></td></tr>';

                echo "</table>";
                echo '<p><label for="contact_input_otherinfo">Other information:</label></p>';
                echo '<p><textarea name="contact_otherinfo" style="width:400px; height:200px"></textarea></p>';
                echo '<input type="submit" name="updatecontact2" value="Update Contact" />';
                echo "</form>";
            } else {
                echo "0 results";
            }
            mysqli_close($this->db_connection);
        } else {
            $this->errors[] = "Sorry, no database connection.";
        }
        mysqli_free_result($row);
    }

    private function updateContact2() {
        echo ('Function updateContact2 starting....');
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
        } elseif (!empty($_POST['contact_firstname']) && !empty($_POST['contact_lastname']) && preg_match('/^[a-z\s\d]{2,100}$/i', $_POST['contact_firstname']) && preg_match('/^[a-z\s\d]{2,100}$/i', $_POST['contact_lastname']) && !empty($_POST['contact_town']) && !empty($_POST['contact_country'])
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
                $contact_firstname = $this->db_connection->real_escape_string(strip_tags($_POST['contact_firstname'], ENT_QUOTES));
                $contact_lastname = $this->db_connection->real_escape_string(strip_tags($_POST['contact_lastname'], ENT_QUOTES));
                $contact_town = $this->db_connection->real_escape_string(strip_tags($_POST['contact_town'], ENT_QUOTES));
                $contact_country = $this->db_connection->real_escape_string(strip_tags($_POST['contact_country'], ENT_QUOTES));
                $contact_phone = $this->db_connection->real_escape_string(strip_tags($_POST['contact_phone'], ENT_QUOTES));
                $contact_email = $this->db_connection->real_escape_string(strip_tags($_POST['contact_email'], ENT_QUOTES));
                $contact_otherinfo = $this->db_connection->real_escape_string(strip_tags($_POST['contact_otherinfo'], ENT_QUOTES));

                
//                THIS IS STILL BROKEN - UPDATE CRITERIA NEEDS FORMULATING
                // Update
                echo ('Writing to DB......');
                $ID = "SELECT * FROM contacts WHERE contact_firstname = '" . $contact_firstname . "';";
                $sql = "UPDATE contacts SET (contact_timestamp = 'contact_timestamp = CURRENT_TIMESTAMP, contact_firstname='" . $contact_firstname . "', contact_lastname='" . $contact_lastname . "', contact_town='" . $contact_town . "', contact_country='" . $contact_country . "', contact_phone='" . $contact_phone . "', contact_email='" . $contact_email . "', contact_otherinfo='" . $contact_otherinfo . ")";
                        
                $query_contact_update = $this->db_connection->query($sql);

                // if contact has been added successfully
                if ($query_contact_update) {
                    $this->messages[] = "Your Contact has been updated successfully.";
                } else {
                    $this->errors[] = "Sorry, your contact update failed. Please go back and try again.";
                }
            }
        } else {
            $this->errors[] = "Sorry, no database connection.";
        }
        mysqli_close($this->db_connection);
    }

}
