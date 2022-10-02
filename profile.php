<?php
/**
 * Displays a user's profile.
 */

 function main() {
    session_start();
    $_SESSION["username"] = "fisher"; // DEBUG
 }

 main();

 include "includes/head.php";
 ?>

 <body>
    <?php
    include "includes/header.php";
    ?>

    <main>
        <h1>Profile</h1>
    </main>
</body>

<?php
include  "includes/tail.php";
?>
