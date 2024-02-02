
<?php

?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mx-auto">
<form action="../actions/register_process.php" method="post" >
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
</div>
<div class="col-md-6 photo-container">
       <img src= "pages/ph.png"  alt="User Photo" >
        </div>
    </div>
</div>

<style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        select,
        input[type="text"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 0.375rem 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            background: transparent;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" width="8" height="8"><path fill="%23333" d="M4 6L0 0h8z"/></svg>');
            background-position: right 0.75rem top 50%;
            background-repeat: no-repeat;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
<?php

?>
