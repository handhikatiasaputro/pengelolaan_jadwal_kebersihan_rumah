<?php
require 'config.php';
require "functions.php";

handleFormSubmission($db);
//mendelete
deleteActivity($db, $id);
?>
