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
            echo '<div class="item">';
            printf("<p>
                Votes: %d
            </p>", $row["score"]);
            printf("<a href=\"post.php?post_id=%u\">%s</a> --- posted by %s <br>
                <a href=\"%s\">%s</a>
            </div>", $row["post_id"], $row["title"], $row["username"], $row["link"], $row["link"]);
        }
        ?>
    </main>
</body>

<?php include "includes/tail.php" ?>
