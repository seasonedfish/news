<?php
/**
 * Shared functions for SQL queries.
 */

require_once "sql_connect.php";

$mysqli = get_mysqli();


function get_all_posts() {
    /**
     * Returns an array of associative arrays (each associative array contains one post's info).
     */
    global $mysqli;

    $result = $mysqli->query("SELECT * FROM posts");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_post_comments(int $post_id) {
    /**
     * Returns an array of associative arrays (each associative array contains one comment's info).
     */
    global $mysqli;

    $statement = $mysqli->prepare("SELECT * FROM comments WHERE post_id = ?"); 
    if(!$statement){
        printf("Query prep failed: %s\n", $mysqli->error);
        exit;
    }
    $statement->bind_param("i", $post_id);
    $statement->execute();

    $result = $statement->get_result();
    $statement->close();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_user(string $username) {
    /**
     * Returns an associative array representing a single user.
     */
    global $mysqli;

    $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ?"); 
    if(!$statement){
        printf("Query prep failed: %s\n", $mysqli->error);
        exit;
    }
    $statement->bind_param("s", $username);
    $statement->execute();

    $result = $statement->get_result();
    $statement->close();
    // fetch_query returns an array of rows, but we only want a single row, so we return the first row.
    return $result->fetch_all(MYSQLI_ASSOC)[0];
}

function get_post(int $post_id) {
    /**
     * Returns an associative array representing a single post.
     */
    global $mysqli;

    $statement = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?"); 
    if(!$statement){
        printf("Query prep failed: %s\n", $mysqli->error);
        exit;
    }
    $statement->bind_param("i", $post_id);
    $statement->execute();

    $result = $statement->get_result();
    $statement->close();
    return $result->fetch_all(MYSQLI_ASSOC)[0];
}

function get_post_author(int $post_id) {
    /**
     * Returns an associative array representing the author of a post.
     */
    global $mysqli;

    $statement = $mysqli->prepare("SELECT users.*, posts.username FROM users JOIN posts ON posts.username = users.username WHERE post_id = ?"); 
    if(!$statement){
        printf("Query prep failed: %s\n", $mysqli->error);
        exit;
    }
    $statement->bind_param("i", $post_id);
    $statement->execute();

    $result = $statement->get_result();
    $statement->close();
    return $result->fetch_all(MYSQLI_ASSOC)[0];
}

function insert_comment(string $body, int $post_id, string $username) {
    /**
     * Inserts a comment into the database.
     */
    global $mysqli;

    $statement = $mysqli->prepare("INSERT INTO comments (comment_id, body, post_id, username) values (NULL, ?, ?, ?)");
    if(!$statement){
        printf("Query prep failed: %s\n", $mysqli->error);
        exit;
    }
    $statement->bind_param("sis", $body, $post_id, $username);
    $statement->execute();
    $statement->close();
}

function insert_post(string $title, string $body, string $link, string $username) {
    /**
     * Inserts a post into the database.
     */
    global $mysqli;

    $statement = $mysqli->prepare(
        "INSERT INTO posts (post_id, title, body, link, score, post_date, username)
        VALUES (NULL, ?, ?, ?, 0, ?, ?)"
    );
    if(!$statement){
        printf("Query prep failed: %s\n", $mysqli->error);
        exit;
    }
    $date = date("Y-m-d");
    $statement->bind_param(
        "sssss",
        $title,
        $body,
        $link,
        $date,
        $username
    );
    $statement->execute();
    $statement->close();
}