<?php
/**
 * The main page, listing all the stories.
 */
require_once "sql_queries.php";

session_start();

include "includes/head.php";
?>

<body>
    <?php include "includes/header.php" ?>
    
    <main>
        <p>
        <?php 
        $rows = get_all_posts();
        foreach ($rows as $row) {
            printf("%s (%s)\n", $row["title"], $row["username"]);
        }
        ?>
        </p>
    </main>
</body>

<?php include "includes/tail.php" ?>
