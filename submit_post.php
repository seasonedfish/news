<?php
/**
 * Allows a user to submit a post.
 */
require_once "sql_queries.php";

function submit() {
    insert_post($_POST["title"], $_POST["body"], $_POST["link"], $_SESSION["username"]);
}

function main() {
    session_start();

    if (isset($_POST["title"])) {
        submit();
    }
}

main();

include "includes/head.php";
?>

<body>
    <?php include "includes/header.php" ?>
    <main>
        <h1>
            Submit a new post
        </h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p>
                <label for="title" class="required">Title:</label>
                <br>
                <input type="text" name="title" id="title" required>
            </p>
            <p>
                <label for="link">Link:</label>
                <br>
                <input type="text" name="link" id="link">
            </p>
            <p>
                <label for="body" class="required">Body:</label>
                <br>
                <textarea name="body" id="body" rows="4" cols="50" required></textarea>
            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
        </form>
    </main>
</body>
