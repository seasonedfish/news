<?php

require_once "sql_queries.php";

$author = null;

function delete() {
    delete_post($_GET["post_id"]);
}

function main() {
    global $author;

    $author = get_post_author($_GET["post_id"]);

    session_start();
    if (!isset($_GET["post_id"])) {
        // If no post_id: exit
        header("Location: index.php");
        exit();
    }

    if (!$_SESSION["username"] !== $author["username"]) {
        // Username doesn't match: don't delete
        header("Location: index.php");
        exit();
    }

    delete();

    header("Location: index.php");
    exit();
}

main();

