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
        <p>
            Profile found
            <?php
            foreach ($user as $key => $value) {
                echo "Key: $key; Value: $value\n";
            }
            ?>
        </p>
    </main>
</body>

<?php
include  "includes/tail.php";
?>
