<?php
/**
 * The code for signing a user out.
 */

session_start();
session_destroy();

header("Location: sign_in.php");
exit();
