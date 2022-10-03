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
            <a href=<?php echo "profile.php?username=" . $author["username"] ?>>
                <?php echo $author["username"]; ?>
            </a>
            on <?php echo date_format(date_create($post["post_date"]), "l, F jS, Y"); ?>
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
        
        <h2>Comments</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>", method="POST">
            <p>
                <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
        </form>

        <div class="comments">
        <?php
            foreach (get_post_comments($post["post_id"]) as $comment) {
                $row = <<<EOF
                <div class="comment">
                    <p class="comment-author">
                        {$comment["username"]}
                    </p>
                    <p class="comment-body">
                        {$comment["body"]}
                    </p>
                </div>
                EOF;
                echo $row;
            }
        ?>
        </div>

    </main>
</body>
