<?php
/**
 * Displays a post and its comments.
 */
require_once "sql_queries.php";

if (!isset($_GET["post_id"])) {
    // If no post_id is given, redirect.
    header("Location: post_not_found.php");
    exit();
}

$post = get_post($_GET["post_id"]);

if (empty($post)) {
    // If no post is found by query, redirect.
    header("Location: post_not_found.php");
    exit();
}

include "includes/head.php";
?>

<body>
    <?php include "includes/header.php" ?>

    <main>
    </main>
</body>
