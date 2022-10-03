<?php
/**
 * Allows a user to edit a comment.
 */
require_once "sql_queries.php";

$comment = null;

function update() {
    global $comment;

    update_comment($comment["comment_id"], $_POST["body"]);
}

function main() {
    global $comment;

    session_start();

    if (!isset($_GET["comment_id"])) {
        // No comment id given
        header("Location: index.php");
        exit();
    }

    $comment = get_comment($_GET["comment_id"]);

    if (empty($comment)) {
        // If no comment is found by query, redirect.
        header("Location: post_not_found.php");
        exit();
    }

    session_start();
    if ($comment["username"] != $_SESSION["username"]) {
        // Username doesn't match
        header("Location: index.php");
        exit();
    }

    if (isset($_POST["body"])) {
        update();
        header("Location: post.php?post_id=" . $comment["post_id"]);
        exit();
    }
}

main();

include "includes/head.php";
?>

<body>
    <?php include "includes/header.php" ?>
    <main>
        <h1>
            Edit comment
        </h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?comment_id=" . $comment["comment_id"];?>" method="POST">
            <p>
                <label for="body" class="required">Body:</label>
                <br>
                <textarea name="body" id="body" rows="4" cols="50" required><?php echo $comment["body"];?></textarea>
            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
        </form>
    </main>
</body>
