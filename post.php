<?php
/**
 * Displays a post and its comments.
 */
require_once "sql_queries.php";

// TODO: PROTECT AGAINST SQL INJECTION
$post = get_post($_GET["post_id"]);

if (empty($post)) {
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
