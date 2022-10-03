<?php

require_once "sql_queries.php";

$post = null;
$author = null;

function delete() {
    delete_post($_GET["post_id"]);
}

function main() {
    global $author;
    global $post;

    $author = get_post_author($_GET["post_id"]);
    $post = get_post($_GET["post_id"]);

    session_start();
    if (!isset($_GET["post_id"])) {
        // If no post_id: exit
        header("Location: index.php");
        exit();
    }

    if ($_SESSION["username"] !== $author["username"]) {
        // Username doesn't match: don't delete
        header("Location: index.php");
        exit();
    }

    if(hash_equals($_SESSION['token'], $_POST['token'])){
        delete();
        header("Location: index.php");
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
            Delete post
        </h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?post_id=" . $post["post_id"];?>" method="POST">
            <p>
                Are you sure you want to delete this post?
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <input type="submit" value="Submit">
            </p>
        </form>
    </main>
</body>

