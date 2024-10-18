<?php
require 'config.php';
require "functions.php";

handleFormSubmission($db);
deleteMember($db,$id);
?>
