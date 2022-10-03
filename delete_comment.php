<?php

require_once "sql_queries.php";

$comment = null;

function delete() {
    delete_comment($_GET["comment_id"]);
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
        if(!hash_equals($_SESSION['token'], $_POST['token'])){
            die("Request forgery detected");
        }

        delete();
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
            Delete comment
        </h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?post_id=" . $comment["comment_id"];?>" method="POST">
            <p>
                Are you sure you want to delete this comment?
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <input type="submit" value="Submit">
            </p>
        </form>
    </main>
</body>

