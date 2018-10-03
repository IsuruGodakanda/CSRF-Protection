<?php
    // Start a Session.
    session_start();

    // Create a key for hash_fmac function.
    if (empty($_SESSION['key']))
        $_SESSION['key'] = bin2hex(random_bytes(32));

    // echo $_SESSION['key'];

    // Create CSRF Token.
    $csrf = hash_fmac('sha256', 'this is some string: index.php', $_SESSION['key']);

    // Validate Token
    if (isset($_POST['submit'])) {
        if (hash_equals($csrf, $_POST['csrf'])) {
            echo "Your name is: " . $_POST['username'];
        } else {
            echo "CSRF Token is Failed.";
        }
    }
?>
<html>
    <head>
        <title>CSRF Protection</title>
    </head>
    <body>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Username" />
            <input type="hidden" name="csrf" value="" />
            <input type="submit" name="submit" value="SUBMIT" />
        </form>
    </body>
</html>