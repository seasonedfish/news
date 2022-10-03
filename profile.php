<?php
/**
 * Displays a user's profile.
 */

require_once "sql_queries.php";

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
            <form action="{$_SERVER['PHP_SELF']}?>" method="POST">
            <p>
                <label for="bio">Update bio:</label>
                <br>
                <textarea name="bio" id="bio" rows="4" cols="50" required>{$user["bio"]}</textarea>
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
