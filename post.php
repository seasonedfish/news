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
         <?php
            foreach ($post as $key => $value) {
                echo "Key: $key; Value: $value\n";
            }
        ?>
        <h1>
            <?php echo $post["title"] ?>
        </h1>
        <a href=<?php echo $post["link"] ?>>
            <?php echo $post["link"] ?>
        </a>
        <p>
            <?php echo $post["body"] ?>
        </p>
    </main>
</body>
