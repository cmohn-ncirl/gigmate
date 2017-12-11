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
    </head>
    <body>
        <?php include 'config/kakorna.php' ?>
        <?php
        // put your code here
        // include the configs / constants for the database connection
        require_once("config/db.php");

// load the registration class
        require_once("classes/UpdateContact.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
        $updatecontact = new UpdateContact();

// show the register view (with the registration form, and messages/errors)
        include("views/updatecontact.php");
