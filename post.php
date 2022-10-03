<?php
/**
 * Displays a post and its comments.
 */
require_once "sql_queries.php";

$post = null;
$author = null;

function comment() {
    global $post;
    insert_comment($_POST["comment"], $post["post_id"], $_SESSION["username"]);
}

function main() {
    global $post;
    global $author;

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

    session_start();
    if (isset($_POST["comment"])) {
        comment();
    }
}

main();

include "includes/head.php";
?>

<body>
    <?php include "includes/header.php" ?>
    <main>
        <h1>
            <?php echo $post["title"] ?>
        </h1>

        <?php
            if (isset($_SESSION['username'])) {
                printf("<a href=\"upvote.php?post_id=%u\">Upvote</a>
                %d
                <a href=\"downvote.php?post_id=%u\">Downvote</a><br>", $post['post_id'], $post["score"], $post['post_id']);
            }
            else {
                printf("<p>
                    Votes: %d
                </p>", $post["score"]);
            }
        ?>

        <small>
            Submitted by
            <a href="<?php echo "profile.php?username=" . $author["username"]?>">
                <?php echo $author["username"];?>
            </a>
            on <?php echo date_format(date_create($post["post_date"]), "l, F jS, Y"); ?>

            <?php
            if ($_SESSION["username"] == $author["username"]) {
                echo "<a href='edit_post.php?post_id={$post["post_id"]}'>(edit)</a>";
                echo " ";
                echo "<a href='delete_post.php?post_id={$post["post_id"]}'>(delete)</a>";
            }
            ?>
        </small>
        
        <p>
            <?php
            if ($post["link"] === null) {
                echo "<i>No link provided.</i>";
            } else {
                /** @noinspection HtmlUnknownTarget */
                printf('<a href=%1$s>%1$s</a>', $post['link']);
            }
            ?>
        <p>
            <?php echo $post["body"] ?>
        </p>
        
        <h2>Comments</h2>
        <?php
            if (isset($_SESSION["username"])) {
                echo <<<EOF
                <form action="{$_SERVER['PHP_SELF']}?post_id={$post["post_id"]}" method="POST">
                    <p>
                        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
                    </p>
                    <p>
                        <input type="submit" value="Submit">
                    </p>
                </form>
                EOF;
            }
        ?>

        <div class="comments">
        <?php
            foreach (get_post_comments($post["post_id"]) as $comment) {
                $comment_heading = $comment["username"];
                if ($comment["username"] === $_SESSION["username"]) {
                    $comment_heading .= "<a href='edit_comment.php?comment_id={$comment["comment_id"]}'>(edit)</a>";
                    $comment_heading .= " ";
                    $comment_heading .= "<a href='delete_comment.php?comment_id={$comment["comment_id"]}'>(delete)</a>";
                }
                $body = preg_replace("((@)(\S+))", "<a href=profile.php?username=$2>@$2</a>", $comment["body"]);

                $row = <<<EOF
                <div class="item">
                    <p class="comment-author">
                        {$comment["username"]}
                    </p>
                    <p class="comment-body">
                        {$body}
                    </p>
                </div>
                EOF;
                echo $row;
            }
        ?>
        </div>
    </main>
</body>
