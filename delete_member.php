<?php
require 'config.php';
require "functions.php";

handleFormSubmission($db);
delete_member($db,$id);

