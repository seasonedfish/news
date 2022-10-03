<?php
/**
 * Shared functions for SQL queries.
 */

require_once "sql_connect.php";

$mysqli = get_mysqli();


function fetch_query(string $query) {
    global $mysqli;

    $result = $mysqli->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_all_posts() {
    return fetch_query("SELECT * FROM posts");
}

function get_post_comments(int $post_id) {
    return fetch_query("SELECT * FROM comments WHERE post_id = " . $post_id);
}

function get_user(string $username) {
    return fetch_query("SELECT * FROM users WHERE username = '" . $username . "'")[0];
}
