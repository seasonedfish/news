<header>
    <nav>
        <a href="index.php"><b>News</b></a>
        <span class="nav-right">
            <?php
                if (isset($_SESSION['username'])) {
                    echo <<<EOF
                    <a href="submit_post.php">Submit post</a> 
                    <a href="profile.php">Profile</a>
                    EOF;
                } else {
                    echo <<<EOF
                    <a href="sign_in.php">Sign in/register</a> 
                    EOF;
                }
            ?>
        </span>
    </nav>
</header>
