<?php
function update() {
    update_bio($_SESSION["username"], $_POST["new_bio"]);
}

function main() {
    session_start();
    if (isset($_POST["new_bio"])) {
        update();
    }
    header("Location: profile.php");
}

main();
