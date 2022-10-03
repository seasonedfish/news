<?php
/**
 * The code for upvoting a post.
 */

require_once "sql_queries.php";

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: post.php?post_id=$post");
    exit();
}

if (!isset($_GET['post_id'])) {
    header("Location: index.php");
    exit();
}

$post = $_GET['post_id'];

upvote($post);

header("Location: post.php?post_id=$post");
exit();
?>