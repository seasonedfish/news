<?php
/**
 * A utility file for updating a user's profile.
 * Previously, this code was part of profile.php,
 * but that made it so that you needed to refresh the page to see the new bio.
 */
require_once "sql_queries.php";

function update() {
    update_bio($_SESSION["username"], $_POST["new_bio"]);
}

function main() {
    session_start();
    if (isset($_POST["new_bio"])) {
        update();
    }
    header("Location: profile.php?username={$_SESSION["username"]}");
}

main();
