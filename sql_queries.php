<?php
/**
 * Shared functions for SQL queries.
 */

require_once "sql_connect.php";

$mysqli = get_mysqli();


function fetch_query(string $query) {
    /**
     * Fetches a query from the database.
     */
    global $mysqli;

    $result = $mysqli->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_all_posts() {
    /**
     * Returns an array of associative arrays (each associative array contains one post's info).
     */
    return fetch_query("SELECT * FROM posts");
}

function get_post_comments(int $post_id) {
    /**
     * Returns an array of associative arrays (each associative array contains one comment's info).
     */
    return fetch_query("SELECT * FROM comments WHERE post_id = " . $post_id);
}

function get_user(string $username) {
    /**
     * Returns an associative array representing a single user.
     */
    // fetch_query returns an array of rows, but we only want a single row, so we return the first row.
    return fetch_query("SELECT * FROM users WHERE username = '" . $username . "'")[0];
}
