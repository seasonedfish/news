<?php
/**
 * The server cannot find a given post.
 */

session_start();

include "includes/head.php";
?>

 <body>
    <?php
    include "includes/header.php";
    ?>

    <main>
        <h1>
            Post not found
        </h1>
        <p>
            The requested post doesn't seem to exist.
        </p>
    </main>
</body>

<?php
include  "includes/tail.php";
?>
