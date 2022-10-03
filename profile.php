<?php
/**
 * Displays a user's profile.
 */

require_once "sql_queries.php";

$user = null;

function main() {
    global $user;

    if (!isset($_GET["username"])) {
        // If no username is given, redirect.
        header("Location: profile_not_found.php");
        exit();
    }

    $user = get_user($_GET["username"]);
    if (empty($user)) {
        // If no profile is found by query, redirect.
        header("Location: profile_not_found.php");
        exit();
    }

    session_start();
}

main();

include "includes/head.php";
?>

 <body>
    <?php
    include "includes/header.php";
    ?>

    <main>
        <h1>
            <?php echo $_GET["username"]; ?>'s profile
        </h1>
        <?php
        if ($_GET["username"] === $_SESSION["username"]) {
            // Allow user to edit bio
            echo <<<EOF
            <form action="profile_update_bio.php?username={$_GET["username"]}" method="POST">
            <p>
                <label for="new_bio">Update bio:</label>
                <br>
                <textarea name="new_bio" id="new_bio" rows="4" cols="50" required>{$user["bio"]}</textarea>
            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
            </form>
            EOF;
        } else {
            // Display bio
            echo <<<EOF
            <p>
                {$user["bio"]}
            </p>
            EOF;
        }
        ?>
    </main>
</body>

<?php
include  "includes/tail.php";
?>
