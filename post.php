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

$author = get_post_author($_GET["post_id"]);

include "includes/head.php";
?>

<body>
    <?php include "includes/header.php" ?>
    <main>
        <h1>
            <?php echo $post["title"] ?>
        </h1>
        <small>
            Submitted by 
            <?php
            echo $author["username"];
            ?>
        </small>
        <p>
            <?php
            if ($post["link"] === null) {
                echo "<i>No link provided.</i>";
            } else {
                printf('<a href=%1$s>%1$s</a>', $post['link']);
            }
            ?>
        <p>
            <?php echo $post["body"] ?>
        </p>
    </main>
</body>
