<?php
/**
 * Displays a user's profile.
 */

require_once "sql_queries.php";
// TODO: PROTECT AGAINST SQL INJECTION
$user = get_user($_GET["username"]);

if (empty($user)) {
    header("Location: profile_not_found.php");
    exit();
}

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
