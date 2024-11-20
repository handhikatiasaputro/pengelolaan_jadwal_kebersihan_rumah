<?php
require 'config.php';
require "functions.php";

handleFormSubmission($db);
//mendelete
delete_activity($db, $id);

