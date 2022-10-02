<?php
/**
 * The main page, listing all the stories.
 */
require_once "sql_queries.php";

include "includes/head.php";
?>

<body>
    <?php include "includes/header.php" ?>
    
    <?php 
    $rows = get_all_posts();
    foreach ($rows as $row) {
        printf("%s (%s)\n", $row["title"], $row["username"]);
    }
    ?>
</body>

<?php include "includes/tail.php" ?>
