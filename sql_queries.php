<?php
/**
 * Shared functions for SQL queries.
 */

require_once "sql_connect.php";

$mysqli = get_mysqli();

function get_all_posts() {
    global $mysqli;

    $result = $mysqli->query("SELECT * FROM posts");

    return $result->fetch_all(MYSQLI_ASSOC);
}