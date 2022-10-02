<?php
/**
 * The code for connecting into the SQL database, can be required by other files.
 */

$mysqli = new mysqli("localhost", "news_inst", "new_pass", "news");

if ($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}