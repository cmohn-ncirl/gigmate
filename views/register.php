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
        <title>Registration</title>
    </head>
    <body>
        <?php
// show potential errors / feedback (from registration object)
        if (isset($registration)) {
            if ($registration->errors) {
                foreach ($registration->errors as $error) {
                    echo $error;
                }
            }
            if ($registration->messages) {
                foreach ($registration->messages as $message) {
                    echo $message;
                }
            }
        }
        ?>

        <!-- register form -->
        <form method="post" action="register.php" name="registerform">

            <!-- the user name input field uses a HTML5 pattern check -->
            <p><label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
                <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
            </p>
            <!-- the email input field uses a HTML5 email type check -->
            <p><label for="login_input_email">User's email</label>
                <input id="login_input_email" class="login_input" type="email" name="user_email" required />
            </p>
            <label for="login_input_password_new">Password (min. 6 characters)</label>
            <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
            <p>
                <label for="login_input_password_repeat">Repeat password</label>
                <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
            </p>
            <input type="submit"  name="register" value="Register" />

        </form>
    </body>
</html>
<!-- backlink -->
<a href="index.php">Back to Login Page</a>
