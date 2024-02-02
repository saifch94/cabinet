<?php

?>

<form action="../actions/register_process.php" method="post">
    <label for="Nomp">Name:</label>
    <input type="text" name="Nomp" required>

    <label for="prénomP">Surname:</label>
    <input type="text" name="prénomP" required>

    <label for="NumTel">Phone:</label>
    <input type="tel" name="NumTel" required>

    <!-- Add a password field -->
    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <!-- Add a confirm password field if necessary -->
    <!-- <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required> -->

    <!-- Add a select field for user role -->
    <label for="role">Role:</label>
    <select name="role" required>
        <option value="PATIENT">Patient</option>
        <option value="ADMIN">Admin</option>
    </select>

    <input type="submit" value="Register">
</form>

<?php

?>
