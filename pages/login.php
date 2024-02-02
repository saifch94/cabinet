<?php
?>

<form action="../actions/login_process.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Login">
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

<?php

?>
